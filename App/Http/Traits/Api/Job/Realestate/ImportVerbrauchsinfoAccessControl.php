<?php 
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\User;
use App\Models\Occupant;
use App\Models\UserVerbrauchsinfoAccessControl;

Trait ImportVerbrauchsinfoAccessControl
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

       

        $occupant = Occupant::where('nekoId','=', $data['neko_lokator_id'])->firstOrFail();
     
     
        $user = User::where('email','=', $data['email'])->firstOrFail();
     
        
   

     /* Anlage des Zählers */
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