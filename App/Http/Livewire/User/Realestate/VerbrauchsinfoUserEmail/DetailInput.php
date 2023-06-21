<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;
use App\Models\VerbrauchsinfoUserEmail;
use DateTime;

class DetailInput extends Component
{
    
    public Occupant $occupant;
    public VerbrauchsinfoUserEmail $current;
    public DateTime $datumStart;
    public DateTime $datumEnde;
    public bool $aktiv;
    public string $email;
    public bool $username;

    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
    }
 
    public function rules()
    {
        return [
            'userEmail.aktiv' => 'nullable',      
            'userEmail.email' => 'required',
            'userEmail.dateFrom' => 'nullable|date', 
            'userEmail.dateTo' => 'nullable|date',
            'userEmail.firstinitUsername' => 'nullable',                   
            'userEmail.nutzeinheitNo' => 'required',      
            'userEmail.realestate_id' => 'required',      
            'userEmail.webupdate' => 'nullable',      
        ];
    }


    public function makeBlankObject()
    {
        $ret_val = VerbrauchsinfoUserEmail::make([
            'realestate_id' => $this->occupant->realestate_id,
            'nutzeinheitNo' => $this->occupant->nutzeinheitNo,
            'dateFrom' => Carbon::now(),
            'aktiv' => 1,
            'webupdate' => 1,
            'email' => 'info@e-neko.de',
        ]);
        return $ret_val;
    }


    public function raise_CreateModal()
    {
        $this->current = $this->makeBlankObject();
        $this->emit('showCreateUserEmailModal', $this->current);   
    }

    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.detail-input');
    }


}
