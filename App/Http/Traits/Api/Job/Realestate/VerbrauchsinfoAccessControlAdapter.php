<?php 
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\User;
use App\Models\Occupant;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use App\Models\UserVerbrauchsinfoAccessControl;

Trait VerbrauchsinfoAccessControlAdapter
{
    
   /* Anlage Der Zähler */
   public function importVerbrauchsinfoAccessControl(Array $data)
   {
        
       /* Validierung der Daten bevor Anlage des Zählers */
       $validator = UserVerbrauchsinfoAccessControl::validateImportData($data);
       if ($validator->fails()) {
           return [
               'function' => 'JobController.UserVerbrauchsinfoAccessControl',
               'result' => 'error',
               'errortype' => 'invalid data',
               'errors' => $validator->errors(),
               'data' => $data,
               'id' => 0
               ];
        }

        $user = DB::table('users')->where('email', $data['email'])->first();
        if (is_null($user)){
                return [
                    'function' => 'JobController.UserVerbrauchsinfoAccessControl',
                    'result' => 'error',
                    'errortype' => 'invalid data',
                    'errors' => 'User not found',
                    'data' => $data,
                    ];
        }    

       // $occupant = Occupant::where('nekoId','=', $data['neko_lokator_id'])->first();
        $occupant = DB::table('occupants')->where('nekoId', $data['neko_lokator_id'])->first();
        if (is_null($occupant)){
            return [
                'function' => 'JobController.UserVerbrauchsinfoAccessControl',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => 'Occupant not found',
                'data' => $data,
                ];
        }

        $userVerbrauchsinfoAccessControl = UserVerbrauchsinfoAccessControl::updateOrcreate(
            [
                    'occupant_id' => $occupant->id,
                    'jahr_monat' => $data['jahr_monat'],
                    'user_id'=> $user->id,
            ],
            [
                    'neko_id'=> $data['neko_id'],
            ]
        );
      
      
        return [
           'function' => 'JobController.userVerbrauchsinfoAccessControl',
           'result' => 'success',
           'id' => $userVerbrauchsinfoAccessControl->id,
       ];

   }

}