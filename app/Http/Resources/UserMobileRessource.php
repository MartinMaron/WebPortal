<?php

namespace App\Http\Resources;

use App\Models\UserVerbrauchsinfoAccessControl;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMobileRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $occupants = $this-> getOccupants();
        return [
            'name' => $this->name,
            'email' => $this->email,
            'isUser' => $this->isUser,
            'isAdmin' => $this->isAdmin,
            'isMieter' => $this->isMieter,
            'kundennummer' => $this->kundennummer,
            'occupants'=> $occupants,
          ];
    }

    public function getOccupants()
    {
        $user = auth()->user();
        $result =  $user->userVerbrauchsinfoAccessControls->map(function (UserVerbrauchsinfoAccessControl $userControl) {
            return new OccupantMobileResource($userControl->occupant);
        })->unique();
        return $result;
    }

}

     
