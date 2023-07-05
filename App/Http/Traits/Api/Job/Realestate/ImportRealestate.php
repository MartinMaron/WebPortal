<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\User;
use App\Models\Realestate;
use App\Http\Resources\CostResource;
use App\Http\Resources\CostKeyResource;
use App\Http\Resources\VerbrauchsinfoUserEmailResource;
use App\Http\Traits\Api\Job\Realestate\OccupantAdapter;
use App\Http\Resources\RealestateAbrechnungssettingResource;
use App\Http\Traits\Api\Job\Realestate\ImportAbrechnungssetting;
use App\Http\Traits\Api\Job\Realestate\VerbrauchsinfoUserEmailAdapter;


trait ImportRealestate
{
    use OccupantAdapter, ImportAbrechnungssetting, ImportCost, ImportCostKey, VerbrauchsinfoUserEmailAdapter;

    /*   Anlage der Liegenschaft */
    public function importRealestate(Array $data)
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
                $retval = $this->importOccupant($occupant);
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
                $retval = $this->importCost($costData);
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
                $retval = $this->importCostKey($costKeydata, $realestate);
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
                $retval = $this->importAbrechnungsSetting($settingsdata, $realestate);
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

            /* Falls verbrauchsinfo dabei sind werden die daten aktualisert */
            $verbrauchsinfosAccs = $data['verbrauchsinfoAccessControls'];
            foreach ($verbrauchsinfosAccs as $verbrauchsinfosAcc){
                $retval = $this->importVerbrauchsinfoAccessControl($verbrauchsinfosAcc);
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


}