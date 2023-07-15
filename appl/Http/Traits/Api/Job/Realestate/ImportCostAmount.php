<?php
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Cost;
use App\Models\CostAmount;

Trait ImportCostAmount 
{
     /* Anlage Der Kostenpositionen */
     public function importCostAmount(Array $data, Cost $cost)
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
}