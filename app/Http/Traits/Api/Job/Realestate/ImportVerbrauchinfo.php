<?php
namespace App\Http\Traits\Api\Job\Realestate;

use Carbon\Carbon;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;


trait ImportVerbrauchinfo
{
    
 
/* Anlage Der Verbrauchsinfos */
public function importVerbrauchinfo(Array $data)
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


}