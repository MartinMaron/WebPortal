<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Occupant;
use App\Models\Realestate;
use Illuminate\Support\Carbon;
use App\Http\Traits\Api\Job\Realestate\ImportVerbrauchinfo;
use App\Http\Traits\Api\Job\Realestate\ImportVerbrauchsinfoCounterMeter;
use App\Http\Traits\Api\Job\Realestate\VerbrauchsinfoAccessControlAdapter;

trait OccupantAdapter
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
             'leerstand' => $data['leerstand'],
             'umlage_nutzerwechsel' => $data['umlageNutzerwechsel'],
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

        return [
             'function' => 'JobController.occupant',
             'result' => 'success',
             'id' => $occupant->id,
         ];
 
     }

     public function getOccupantCoreDataByNekoId($data){
        $occupant = Occupant::where('nekoId','=', $data)->firstOrFail();
        return $occupant;
    }

    private function getNextOccupantUnvid($unvid){
        $nr = intval(substr($unvid, 15, 3));
        $nr++;
        return substr($unvid, 0, 15). str_pad($nr,3,'0',STR_PAD_LEFT);
    }

    private function generateNewAddress(Occupant $occupant){
        


    }

    public function makeDefaultOccupant(Occupant $oldOccupant)
    {
        return Occupant::make([
        'nekoId' => 'new',
        'realestate_id' => $oldOccupant->realestate_id,
        'budguid' => $oldOccupant->realestate->nekoId,
        'nutzeinheitNo' => $oldOccupant->nutzeinheitNo,
        'unvid' => $this->getNextOccupantUnvid($oldOccupant->unvid),
        'nachname' => "Neuer Nutzer",
        'vorname' => "",
        'street' => $oldOccupant->street,
        'postcode' => $oldOccupant->postcode,
        'houseNr' => $oldOccupant->houseNr,
        'city' => $oldOccupant->city,
        'vat' => $oldOccupant->vat,
        'uaw' => $oldOccupant->uaw,
        'qmkc' => $oldOccupant->qmkc,
        'qmww' => $oldOccupant->qmww,
        'pe' => $oldOccupant->pe,
        'lokalart' => $oldOccupant->lokalart,
        'customEinheitNo' => $oldOccupant->customEinheitNo,
        'lage' => $oldOccupant->lage,
        'eigentumer' => $oldOccupant->eigentumer,
        'dateFrom' => new Carbon(),
        ]);
    }


    public function changeOccupant(Occupant $initOccupant, Occupant $newOccupant, Bool $isEmpty, $newDate){
        
        if($isEmpty){
            $newOccupant->nachname = "Leerstand";
            $newOccupant->pe = 1;
            $newOccupant->leerstand = true;
        }
        $newOccupant->dateFrom = $newDate;
        $newOccupant->nekoId = "new";
        $save = $this->editOccupant($newOccupant);
        if($save->wasRecentlyCreated)
        {
            $initOccupant->dateTo = (new carbon($newDate))->addDay(-1);
            $initOccupant->save();
        }
        return $save;
    }

    public function editOccupant(Occupant $occupant){

        return Occupant::updateOrcreate(
            ['id' => $occupant['id']],
            ['nekoId' => $occupant['nekoId'],
                'realestate_id' => $occupant['realestate_id'],
                'unvid' => $occupant['unvid'],
                'budguid' => $occupant['budguid'],
                'nutzeinheitNo' => $occupant['nutzeinheitNo'],
                'dateFrom' => $occupant['dateFrom'],
                'dateTo' => $occupant['dateTo'],
                'anrede' => $occupant['anrede'],
                'title' => $occupant['title'],
                'nachname' => $occupant['nachname'],
                'vorname' => $occupant['vorname'],
                'address' => $occupant['address'],
                'street' => $occupant['street'],
                'postcode' => $occupant['postcode'],
                'houseNr' => $occupant['houseNr'],
                'city' => $occupant['city'],
                'vat' => $occupant['vat'],
                'uaw' => $occupant['uaw'],
                'qmkc' => $occupant['qmkc'],
                'qmww' => $occupant['qmww'],
                'pe' => $occupant['pe'],
                'bemerkung' => $occupant['bemerkung'],
                'vorauszahlung' => $occupant['vorauszahlung'],
                'lokalart' => $occupant['lokalart'],
                'customEinheitNo' => $occupant['customEinheitNo'],
                'lage' => $occupant['lage'],
                'leerstand' => $occupant['leerstand'],
                'email' => $occupant['email'],
                'telephone_number' => $occupant['telephone_number'],
                'eigentumer' => $occupant['eigentumer'],
            ]
        );

    }


}