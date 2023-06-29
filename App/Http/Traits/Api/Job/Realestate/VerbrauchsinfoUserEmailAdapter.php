<?php 
namespace App\Http\Traits\Api\Job\Realestate; 

use App\Models\Realestate;
use App\Models\VerbrauchsinfoUserEmail;

Trait VerbrauchsinfoUserEmailAdapter
{
    
    
    public function importVerbrauchsinfoUserEmail(Array $data, Realestate $realestate)
    {

        /* Validierung der Daten vor Anlage  */
        $validator = VerbrauchsinfoUserEmail::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.verbrauchsinfoUserEmail',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }
   
         /* Anlage der Emailsteuerungstabelle für Verbraucherinformationen */
        $importObj = VerbrauchsinfoUserEmail::updateOrcreate(
            [
                'neko_id' => $data['neko_id']
            ],
            [
               'realestate_id' => $realestate->id,
               'dateFrom'=> $data['dateFrom'],
               'tryWebDelete'=> $data['TryWebDelete'],
               'dateTo'=> $data['dateTo'],
               'nutzeinheitNo'=> $data['msk_nr'],
               'aktiv'=> $data['aktiv'],
               'email'=> $data['email'],
            ]
        );
   
        return [
            'function' => 'JobController.importVerbrauchsinfoUserEmail',
            'result' => 'success',
            'id' => $importObj->id,
        ];
   
    }






}