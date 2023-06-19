<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

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
            'userEmail.email' => 'nullable',
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
        dd('closeModal');
   
        /*  if ($save && $this->costAmount){  
            if ($this->validate())
            {
                $this->costAmount->save();
                $this->showCostAmountEditModal = false ;
                $this->emit('refreshComponents');    
            }else{
                $this->showCostAmountEditModal = false;              
            };
        }else{
            $this->showCostAmountEditModal = false;
        }     */         
   }

    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.detail');
    }
}
