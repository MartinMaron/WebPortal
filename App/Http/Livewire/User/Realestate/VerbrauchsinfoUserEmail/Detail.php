<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\VerbrauchsinfoUserEmail;
use Livewire\Component;

class Detail extends Component
{
    public VerbrauchsinfoUserEmail $userEmail;
    public $showEditModal = false;

    protected $listeners = [
        'showUserEmailModal' => 'showModal',
        'closeUserEmailModal' => 'closeModal',
    ];
   
    public function rules()
    {
        return [
            'userEmail.aktiv' => 'nullable',      
            'userEmail.email' => 'required',
            'userEmail.dateFrom' => 'nullable|date', 
            'userEmail.dateTo' => 'nullable|date',
            'userEmail.firstinitUsername' => 'nullable',                   
        ];
    }

    public function showModal (VerbrauchsinfoUserEmail $userEmail){
        $this->userEmail = $userEmail;
        $this->showEditModal = true;
    }

    public function closeModal($save){
        if ($save && $this->userEmail){  
            if ($this->validate())
            {
                $this->userEmail->save();
                $this->emit('refreshParent');    
                $this->showEditModal = false ;
            }else{
                $this->showEditModal = true;              
            };
        }else{
            $this->showEditModal = false;
        }         
   }

    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.detail');
    }
}
