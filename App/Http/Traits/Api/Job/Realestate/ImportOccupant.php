<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Occupant;
use App\Models\Realestate;
use App\Http\Traits\Api\Job\Realestate\ImportVerbrauchinfo;
use App\Http\Traits\Api\Job\Realestate\ImportVerbrauchsinfoCounterMeter;
use App\Http\Traits\Api\Job\Realestate\VerbrauchsinfoAccessControlAdapter;

trait ImportOccupant
{
    use ImportVerbrauchsinfoCounterMeter, ImportVerbrauchinfo, VerbrauchsinfoAccessControlAdapter;


     /* Anlage des Mieters  */
     public function importOccupant(Array $data)
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
             $retval = $this->importVerbrauchsinfoCounterMeter($verbrauchsinfoCounterMeter);
             if ($retval['result'] == 'error'){
                 return $retval;
             }
         }
 
     

        /* Falls dabei ...  werden die daten aktualisert */
        $verbrauchsinfos = $data['verbrauchsinfos'];
        foreach ($verbrauchsinfos as $verbrauchsinfo){
            $retval = $this->importVerbrauchinfo($verbrauchsinfo);
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


        return [
             'function' => 'JobController.occupant',
             'result' => 'success',
             'id' => $occupant->id,
         ];
 
     }

}