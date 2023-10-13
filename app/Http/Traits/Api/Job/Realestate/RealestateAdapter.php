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


trait RealestateAdapter
{
    use OccupantAdapter, ImportAbrechnungssetting, ImportCost, ImportCostKey, VerbrauchsinfoUserEmailAdapter, InvoiceAdapter;

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

        
        if(User::where('email', $data['email'])->exists() && $data['nekoToWebUpdate'] == true) {
            /* Finden des users über email */
            $user = User::where('email','=', $data['email'])->firstOrFail();
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
        }else{
            $realestate = Realestate::where('nekoId','=', $data['nekoId']);
        }


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

            /* Falls Rechnungen dabei sind werden die daten aktualisert */
            $invoices = $data['invoices'];
            foreach ($invoices as $invoice){
                $retval = $this->importInvoice($invoice, $realestate);
                if ($retval['result'] == 'error'){
                    return $retval;
                }
            }

            /* Realestate-id wird zurückgegeben */
            return [
                'function' => 'JobController.realestate',
                'result' => 'success',
                'id' => $realestate->id,
            ];
          
    }

}