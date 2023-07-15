<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\CostKey;
use App\Models\Realestate;


Trait ImportCostKey 
{
    /* Anlage Der Kostenverteilungsschlüsselinformationen */
    public function importCostKey(Array $data, Realestate $realestate)
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


}

