<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Realestate;
use App\Models\RealestateAbrechnungssetting;

Trait ImportAbrechnungssetting {

    /* Anlage Der Kostenpositionen */
    public function importAbrechnungsSetting(Array $data, Realestate $realestate)
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
            'function' => 'JobController.abrechnungsSetting',
            'result' => 'success',
            'id' => $settingObj->id,
        ];

    }

}
