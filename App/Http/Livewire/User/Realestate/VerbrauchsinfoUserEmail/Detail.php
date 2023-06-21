<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;
use App\Models\VerbrauchsinfoUserEmail;


class Detail extends Component
{
    public VerbrauchsinfoUserEmail $userEmail;
    public Occupant $occupant;
    public $showEditModal = false;
    public string $dialogMode = '';



    protected $listeners = [
        'showUserEmailModal' => 'showModal',
        'closeUserEmailModal' => 'closeModal',
        'showCreateUserEmailModal' => 'showCreateUserEmailModal'
    ];
   
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

    public function showModal (VerbrauchsinfoUserEmail $userEmail){
        $this->dialogMode = 'edit';
        $this->userEmail = $userEmail;
        $this->showEditModal = true;
    }

    public function closeModal($save){
        if ($save && $this->userEmail){  
            if ($this->validate())
            {
                if($this->dialogMode == 'create')
                {
                    VerbrauchsinfoUserEmail::create($this->userEmail);
                    $this->userEmail->save();
                }
                if($this->dialogMode == 'edit')
                {
                    $this->userEmail->save();
                    
                }
                $this->emit('refreshParent');    
                $this->showEditModal = false ;
            }else{
                $this->showEditModal = true;              
            };
        }else{
            $this->showEditModal = false;
        }       
   }

    public function showCreateUserEmailModal($userEmail)
    {
        $this->dialogMode = 'create';
        $this->userEmail = $userEmail;
        $this->showEditModal = true;
    }

    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.detail');
    }
}
