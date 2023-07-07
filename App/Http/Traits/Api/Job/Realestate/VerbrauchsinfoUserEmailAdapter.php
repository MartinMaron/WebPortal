<?php 
namespace App\Http\Traits\Api\Job\Realestate; 

use App\Models\Realestate;
use Illuminate\Support\Facades\DB;
use App\Models\VerbrauchsinfoUserEmail;

Trait VerbrauchsinfoUserEmailAdapter
{
    
    
    public function importVerbrauchsinfoUserEmail(Array $data, Realestate $realestate)    {

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
                'id' => $data['id']
            ],
            [
                'neko_id' => $data['neko_id'],
                'realestate_id' => $realestate->id,
                'dateFrom'=> $data['dateFrom'],
                'tryWebDelete'=> $data['TryWebDelete'],
                'dateTo'=> $data['dateTo'],
                'nutzeinheitNo'=> $data['msk_nr'],
                'email'=> $data['email'],
            ]
        );
   
        return [
            'function' => 'JobController.importVerbrauchsinfoUserEmail',
            'result' => 'success',
            'id' => $importObj->id,
        ];
   
    }

    public function deleteVerbrauchsinfoUserEmail($data){
          /* extrahieren der Daten */
          $neko_id = $data;
          $result = DB::table('verbrauchsinfo_user_emails')->where('neko_id', $neko_id)->delete();

          if($result==1)
          {
              return response()->json([
                  'function' => 'JobController.job.deleteVerbrauchsinfoUserEmail',
                  'result' => 'success',
                  'id' => $neko_id,
                  'data' => $data,
              ]);
          }else {
              /* Fehlermeldung falls ein Job unbekannt ist */
              return response()->json([
                  'function' => 'JobController.job',
                  'result' => 'error',
                  'error' => ' datensatz existiert nicht mehr oder konnte nicht gelöscht werden',
              ]);
          }       
        
    }

}