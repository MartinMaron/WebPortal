<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Cost;
use App\Models\Realestate;

Trait ImportCost
{
    use ImportCostAmount;

    /* Anlage Der Kosteninformationen */
    public function importCost(Array $data)
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
            $retval = $this->importCostAmount($costAmount, $cost);
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

} 