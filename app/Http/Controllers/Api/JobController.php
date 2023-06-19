<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\User;
use App\Models\CostKey;
use App\Models\Occupant;
use App\Models\CostAmount;
use App\Models\Realestate;
use App\Models\CounterMeter;
use Illuminate\Http\Request;
use App\Models\Verbrauchsinfo;
use App\Http\Controllers\Controller;
use App\Http\Resources\CostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CostKeyResource;
use App\Http\Resources\JobDataResource;
use App\Models\VerbrauchsinfoUserEmail;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RealestateResource;
use App\Models\VerbrauchsinfoCounterMeter;
use App\Models\RealestateAbrechnungssetting;
use App\Http\Resources\RealestateAbrechnungssettingResource;
use App\Http\Resources\VerbrauchsinfoUserEmailResource;

class JobController extends Controller
{
    public function job(Request $request)
    {
        /* angaben um welchen Job es sich handelt und dazugehörigen Daten */
        $jobData = New JobDataResource($request);

        /* auswahl des Jobs und anschliessende Bearbeitung  */
        if($jobData['job']=='register')
        {
            $data = new UserResource($jobData['data']);
            return $this->register($data->resource) ;
        }elseif($jobData['job']=='realestate'){
            /* Realestate-Resoource wird erzeugt*/
            $res = new RealestateResource($jobData['data']);
            /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
            $data = $res->toArray($res->resource);
            /* Verarbeitn der Daten */
            $retval = $this->realestate($data);
            return response()->json($retval);
        }
        else {
            /* Fehlermeldung falls ein Job unbekannt ist */
            return response()->json([
                'function' => 'JobController.job',
                'result' => 'error',
                'error' => $jobData['job']. ' wurde nicht implementiert',
           ]);
        }

    }


    public function register(Array $data)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'function' => 'JobController.register',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0,
                ]);
        }

        $user = User::updateOrcreate(
            ['email' => $data['email']],
            ['name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isUser' => $data['isUser'],
            'isAdmin' => $data['isAdmin'],
            'isMieter' => $data['isMieter'],
            'kundennummer' => $data['kundennummer']
            ]
            );


        return response()->json([
            'function' => 'JobController.register',
            'result' => 'success',
            'id' => $user->id,
            'data' => $data,
        ]);

    }

    /*   Anlage der Liegenschaft */
    public function realestate(Array $data)
    {

        $validator = Realestate::validateImportData($data);
        if ($validator->fails()) {
            return response()->json([
                'function' => 'JobController.register',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0,
                ]);
        }


        /* Finden des users über email */
        $users = User::where('email','=', $data['email'])->get();
        /* upsert der Daten der Liegenschaft */
        foreach($users as $user) {
            /* Realestate-Objekt aktualisieren */
            $realestate = Realestate::updateOrcreate(
                ['nekoId' => $data['nekoId']],
                ['unvid' => $data['unvid'],
                'address' => $data['address'],
                'miete' => $data['miete'],
                'user_id' => $user->id,
                'street' => $data['street'],
                'postCode' => $data['postCode'],
                'city' => $data['city'],
                'dateFrom' => $data['dateFrom'],
                'dateTo' => $data['dateTo'],
                'heizkosten' => $data['heizkosten'],
                'rauchmelder' => $data['rauchmelder']]
            );


            /* Falls nutzer dabei sind werden die daten aktualisert */
            /* die Zuordnung erfogt über die nekoId der Liegenschaft und Mieter */
            $occupants = $data['occupants'];
            foreach ($occupants as $occupant){
                $retval = $this->occupant($occupant);
                if ($retval['result'] == 'error'){
                    return response()->json($retval);
                }
            }



            /* Falls nutzer dabei sind werden die daten aktualisert */
            /* die Zuordnung erfogt über die nekoId der Liegenschaft und Mieter */
            $costs = $data['costs'];
            foreach ($costs as $cost){
                /* Cost-Resoource wird erzeugt*/
                $res = new CostResource($cost);
                /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
                $costData = $res->toArray($res->resource);
                /* Verarbeitn der Daten */
                $retval = $this->cost($costData);
                if ($retval['result'] == 'error'){
                    return $retval;
                }
            }

           $costKeys = $data['costsKeys'];
            foreach ($costKeys as $costKey){
                /* CostKey-Resoource wird erzeugt*/
                $res = new CostKeyResource($costKey);
                /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
                $costKeydata = $res->toArray($res->resource);
                /* Verarbeitn der Daten */
                $retval = $this->costKey($costKeydata, $realestate);
                if ($retval['result'] == 'error'){
                    return $retval;
                }
            }

            $abrechnungsSettings = $data['abrechnungSettings'];
            foreach ($abrechnungsSettings as $abrechnungsSetting){
                /* Resoource wird erzeugt*/
                $res = new RealestateAbrechnungssettingResource($abrechnungsSetting);
                /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
                $settingsdata = $res->toArray($res->resource);
                /* Verarbeitn der Daten */
                $retval = $this->abrechnungsSetting($settingsdata, $realestate);
                if ($retval['result'] == 'error'){
                    return $retval;
                }
            }

          
            $verbrauchsinfoUserEmails = $data['verbrauchsinfoUserEmails'];
            foreach ($verbrauchsinfoUserEmails as $verbrauchsinfoUserEmail){
                /* Resoource wird erzeugt*/
                $res = new VerbrauchsinfoUserEmailResource($verbrauchsinfoUserEmail);
                /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
                $settingsdata = $res->toArray($res->resource);
                /* Verarbeitn der Daten */
                $retval = $this->importVerbrauchsinfoUserEmail($settingsdata, $realestate);
                if ($retval['result'] == 'error'){
                    return $retval;
                }
            }


            /* Realestate-id wird zurückgegeben */
            return response()->json([
                'function' => 'JobController.realestate',
                'result' => 'success',
                'id' => $realestate->id,
            ]);
        }
    }
    /* Anlage des Mieters  */
    public function occupant(Array $data)
    {
        $validator = Occupant::validateImportData($data);

        if ($validator->fails()) {
            return [
                'function' => 'JobController.occupant',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0,
                ];
        }

        $realestate = Realestate::where('nekoId','=', $data['budguid'])->firstOrFail();
        $occupant = Occupant::updateOrcreate(
            ['nekoId' => $data['nekoId']],
            ['unvid' => $data['unvid'],
            'budguid' => $data['budguid'],
            'nutzeinheitNo' => $data['nutzeinheitNo'],
            'dateFrom' => $data['dateFrom'],
            'dateTo' => $data['dateTo'],
            'nachname' => $data['nachname'],
            'address' => $data['address'],
            'city' => $data['city'],
            'street' => $data['street'],
            'houseNr' => $data['houseNr'],
            'postcode' => $data['postcode'],
            'vat' => $data['vat'],
            'uaw' => $data['uaw'],
            'qmkc' => $data['qmkc'],
            'qmww' => $data['qmww'],
            'realestate_id' => $realestate->id,
            'pe' => $data['pe'],
            'vorauszahlung' => $data['vorauszahlung'],
            'customEinheitNo' => $data['customEinheitNo'],
            'email' => $data['email'],
            'lage' => $data['lage']]
        );

        /* Falls zähler dabei sind werden die daten aktualisert */
        $verbrauchsinfoCounterMeters = $data['verbrauchsinfoCounterMeter'];
        foreach ($verbrauchsinfoCounterMeters as $verbrauchsinfoCounterMeter){
            $retval = $this->verbrauchsinfoCounterMeter($verbrauchsinfoCounterMeter);
            if ($retval['result'] == 'error'){
                return $retval;
            }
        }

        /* Falls verbrauchsinfo dabei sind werden die daten aktualisert */
        $verbrauchsinfos = $data['verbrauchsinfos'];
        foreach ($verbrauchsinfos as $verbrauchsinfo){
            $retval = $this->verbrauchinfo($verbrauchsinfo);
            if ($retval['result'] == 'error'){
                return $retval;
            }
        }

        return [
            'function' => 'JobController.occupant',
            'result' => 'success',
            'id' => $occupant->id,
        ];

    }
    /* Anlage Der Zähler */
    public function verbrauchsinfoCounterMeter(Array $data)
    {

        /* Validierung der Daten bevor Anlage des Zählers */
        $validator = VerbrauchsinfoCounterMeter::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.verbrauchsinfoCounterMeter',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }

        $dat = new Carbon($data['jahr_monat']);
  
        $occupant = Occupant::where('nekoId','=', $data['nekoOccupant_id'])->firstOrFail();
        /* Anlage des Zählers */
        $counterMeter = VerbrauchsinfoCounterMeter::updateOrcreate(
            [
                'nekoId' => $data['nekoId'],
                'jahr_monat' => $data['jahr_monat'],
            ],
            ['nr'=> $data['nr'],
            'funkNr'=> $data['funkNr'],
            'art'=> $data['art'],
            'occupant_id' => $occupant->id,
            'einheit_id'=> $data['einheit_id'],
            'stand_ende'=> $data['stand_ende'],
            'stand_anfang'=> $data['stand_anfang'],
            'faktor'=> $data['faktor'],
            'nutzergrup_id'=> $data['nutzergrup_id'],
            'nutzergrup_name'=> $data['nutzergrup_name'],
            'zeitraum_akt'=> $data['zeitraum_akt'],
            'zeitraum_mon'=> $data['zeitraum_mon'],
            'zeitraum_vorj'=> $data['zeitraum_vorj'],
            'verbrauch_akt'=> $data['verbrauch_akt'],
            'hk'=> $data['hk'],
            'ww'=> $data['ww'],
            'verbrauch_mon'=> $data['verbrauch_mon'],
            'verbrauch_vorj'=> $data['verbrauch_vorj'],
            'datum'=> $dat->year.'/'.$dat->month.'/'.$dat->day ,
            ]
        );

      
         return [
            'function' => 'JobController.counterMeter',
            'result' => 'success',
            'id' => $counterMeter->id,
        ];

    }

    /* Anlage Der Verbrauchsinfos */
    public function verbrauchinfo(Array $data)
    {

        /* Validierung der Daten bevor Anlage des Zählers */
        $validator = Verbrauchsinfo::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.verbrauchsinfo',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }

        $occupant = Occupant::where('nekoId','=', $data['nekoOccupant_id'])->firstOrFail();

        $dat = new Carbon($data['jahr_monat']);
  
        
        /* Anlage des Zählers */
        $verbrauchsinfo = Verbrauchsinfo::updateOrcreate(
            [
                'nekoId' => $data['nekoId'],
                'jahr_monat' => $data['jahr_monat'],
            ],
            ['art'=> $data['art'],
            'occupant_id' => $occupant->id,
           // 'einheit'=> $data['einheit'],
            'einheit_id'=> $data['einheit_id'],
            'nutzergrup_id'=> $data['nutzergrup_id'],
            'nekoOccupant_id'=> $data['nekoOccupant_id'],
            'nutzergrup_name'=> $data['nutzergrup_name'],
            'hk'=> $data['hk'],
            'ww'=> $data['ww'],
            'datum'=> $dat->year.'/'.$dat->month.'/'.$dat->day ,
            'durchschnitt'=> $data['durchschnitt'],
            'zeitraum_akt'=> $data['zeitraum_akt'],
            'zeitraum_mon'=> $data['zeitraum_mon'],
            'zeitraum_vorj'=> $data['zeitraum_vorj'],
            'verbrauch_akt'=> $data['verbrauch_akt'],
            'verbrauch_mon'=> $data['verbrauch_mon'],
            'verbrauch_vorj'=> $data['verbrauch_vorj']]
        );

        return [
            'function' => 'JobController.counterMeter',
            'result' => 'success',
            'id' => $verbrauchsinfo->id,
        ];

    }


    /* Anlage Der Kosteninformationen */
    public function cost(Array $data)
    {
        /* Validierung der Daten bevor Anlage des Zählers */
        $validator = Cost::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.Cost',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }

        /* Ermitteln der Liegenschaft */
        $realestate = Realestate::where('nekoId','=', $data['budguid'])->firstOrFail();

        /* Anlage des Zählers */
        $cost = Cost::updateOrcreate(
            ['nekoId' => $data['nekoId']],
            ['unvid'=> $data['unvid'],
            'realestate_id'=> $realestate->id,
            'budguid' => $data['budguid'],
            'nazwa' => $data['nazwa'],
            'bemerkung' => $data['bemerkung'],
            'tryWebDelete' => $data['tryWebDelete'],
            'costType' => $data['costType'],
            'costType_id' => $data['costType_id'],
            'vatAmount' => $data['vatAmount'],
            'fuelType' => $data['fuelType'],
            'fuelType_id' => $data['fuelType_id'],
            'hasTank' => $data['hasTank'],
            'startValue' => $data['startValue'],
            'endValue' => $data['endValue'],
            'startValueAmount' => $data['startValueAmount'],
            'haushaltsnah' => $data['haushaltsnah'],
            'keyId' => $data['keyId'],
            'keyName' => $data['keyName'],
            'keyShortkey' => $data['keyShortkey'],
            'costAbrechnungType' => $data['costAbrechnungType'],
            'costAbrechnungTypeId' => $data['costAbrechnungTypeId'],
            'fuelTypeUnitType' => $data['fuelTypeUnitType'],
            'fuelTypeUnitName' => $data['fuelTypeUnitName'],
            'startValueAmountNet' => $data['startValueAmountNet'],
            'startValueAmountGros' => $data['startValueAmountGros'],
            'keyUnitType' => $data['keyUnitType'],
            'consumption' => $data['consumption'],
            ]
        );

        /* Falls Kostenpositionen dabei sind werden die daten aktualisert */
        $costAmounts = $data['costamounts'];
        foreach ($costAmounts as $costAmount){
            $retval = $this->costAmount($costAmount, $cost);
            if ($retval['result'] == 'error'){
                return $retval;
            }
        }


         return [
            'function' => 'JobController.Cost',
            'result' => 'success',
            'id' => $cost->id,
        ];

    }

    /* Anlage Der Kostenverteilungsschlüsselinformationen */
    public function costKey(Array $data, Realestate $realestate)
    {
        /* Validierung der Daten bevor Anlage des Zählers */
        $validator = CostKey::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.CostKey',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }

        /* Anlage des Zählers */
        $costKey = CostKey::updateOrcreate(
            [
                'realestate_id' => $realestate ,
                'nekoKey_id' => $data['nekoKey_id'] ,
            ],
            [
                'nekoCostKey_id'=> $data['nekoCostKey_id'],
                'nekoKey_id'=> $data['nekoKey_id'],
                'realestate_id'=> $realestate->id,
                'bemerkung' => $data['bemerkung'],
                'tryWebDelete' => $data['tryWebDelete'],
                'description'=> $data['description'],
                'zeitanteil'=> $data['zeitanteil'],
                'einheit'=> $data['einheit'],
                'shortKey'=> $data['shortKey'],
                'viewText'=> $data['viewText'],
            ]
        );

         return [
            'function' => 'JobController.CostKey',
            'result' => 'success',
            'id' => $costKey->id,
        ];

    }

    /* Anlage Der Kostenpositionen */
    public function costAmount(Array $data, Cost $cost)
    {

        /* Validierung der Daten bevor Anlage  */
        $validator = CostAmount::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.CostAmount',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }

        /* Anlage der Kostenpositionen */
        $costAmount = CostAmount::updateOrcreate(
            [
                'nekoId' => $data['nekoCostAmountId'] ,
            ],
            [
                'cost_id'=> $cost->id,
                'bemerkung'=> $data['bemerkung'],
                'tryWebDelete'=> $data['tryWebDelete'],
                'description'=> $data['description'],
                'netAmount'=> $data['netAmount'],
                'grosAmount'=> $data['grosAmount'],
                'dateCostAmount' => $data['dateCostAmount'],
                'consumption' => $data['consumption'],
                'grosAmount_HH' => $data['grosAmount_HH'],
                'nekoId' => $data['nekoCostAmountId'],
            ]
        );

        return [
            'function' => 'JobController.CostAmount',
            'result' => 'success',
            'id' => $costAmount->id,
        ];

    }

 /* Anlage Der Kostenpositionen */
 public function abrechnungsSetting(Array $data, Realestate $realestate)
 {

     /* Validierung der Daten vor Anlage  */
     $validator = RealestateAbrechnungssetting::validateImportData($data);
     if ($validator->fails()) {
         return [
             'function' => 'JobController.abrechnungsSetting',
             'result' => 'error',
             'errortype' => 'invalid data',
             'errors' => $validator->errors(),
             'data' => $data,
             'id' => 0
             ];
     }

      /* Anlage der Kostenpositionen */
     $settingObj = RealestateAbrechnungssetting::updateOrcreate(
         [
             'neko_id' => $data['neko_id']
         ],
         [
            'realestate_id' => $realestate->id,
            'bemerkung'=> $data['bemerkung'],
            'tryWebDelete'=> $data['tryWebDelete'],
            'description'=> $data['description'],
            'nabi_inhaber'=> $data['nabi_inhaber'],
            'nabi_nr'=> $data['nabi_nr'],
            'stromkosten'=> $data['stromkosten'],
            'brenwert_gasabrechnug'=> $data['brenwert_gasabrechnug'],
            'eigen_energielieferung'=> $data['eigen_energielieferung'],
            'aktiv'=> $data['aktiv'],
            'neko_id' => $data['neko_id'],
         ]
     );

     return [
         'function' => 'JobController.CostAmount',
         'result' => 'success',
         'id' => $settingObj->id,
     ];

    }

    public function importVerbrauchsinfoUserEmail(Array $data, Realestate $realestate)
 {

     /* Validierung der Daten vor Anlage  */
     $validator = VerbrauchsinfoUserEmail::validateImportData($data);
     if ($validator->fails()) {
         return [
             'function' => 'JobController.verbrauchsinfoUserEmail',
             'result' => 'error',
             'errortype' => 'invalid data',
             'errors' => $validator->errors(),
             'data' => $data,
             'id' => 0
             ];
     }

      /* Anlage der Emailsteuerungstabelle für Verbraucherinformationen */
     $importObj = VerbrauchsinfoUserEmail::updateOrcreate(
         [
             'neko_id' => $data['neko_id']
         ],
         [
            'realestate_id' => $realestate->id,
            'dateFrom'=> $data['dateFrom'],
            'tryWebDelete'=> $data['TryWebDelete'],
            'dateTo'=> $data['dateTo'],
            'nutzeinheitNo'=> $data['msk_nr'],
            'aktiv'=> $data['aktiv'],
            'email'=> $data['email'],
         ]
     );

     return [
         'function' => 'JobController.importVerbrauchsinfoUserEmail',
         'result' => 'success',
         'id' => $importObj->id,
     ];

    }






}
