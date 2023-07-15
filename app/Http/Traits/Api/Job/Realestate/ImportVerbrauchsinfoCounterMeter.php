<?php
namespace App\Http\Traits\Api\Job\Realestate;

use Carbon\Carbon;
use App\Models\Occupant;
use App\Models\VerbrauchsinfoCounterMeter;


trait ImportVerbrauchsinfoCounterMeter
{
    
   /* Anlage Der Zähler */
   public function importVerbrauchsinfoCounterMeter(Array $data)
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

}