<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;
use App\Models\VerbrauchsinfoUserEmail;
use DateTime;

class Detail extends Component
{
    public $userEmail;
    public Occupant $occupant;
    public $showEditModal = false;
    public string $dialogMode = '';

    public bool $aktiv;
    public string $email;
    public DateTime $dateFrom; 
    public Datetime $dateTo;
    public string $firstinitUsername;                
    
    protected $listeners = [
        'showUserEmailModal' => 'showModal',
        'closeUserEmailModal' => 'closeModal',
        'showCreateUserEmailModal' => 'createModal'
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

    public function showModal ($userEmail){
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
                    $ret_val = VerbrauchsinfoUserEmail::create($this->userEmail);
           //         $ret_val->save();
                }
                if($this->dialogMode == 'edit')
                {
             //       dd($this->userEmail);
               

                    $ret_val = VerbrauchsinfoUserEmail::updateOrcreate(
                        ['id' => $this->userEmail['id']],
                        ['aktiv' => $this->userEmail['aktiv'],
                        'email' => $this->userEmail['email'],
                        'dateFrom' => $this->userEmail['dateFrom'],
                        'date_to_editing' => $this->userEmail['dateTo'],
                        'firstinitUsername' => $this->userEmail['firstinitUsername'],
                        ]
                        );
                //    $this->ret_val->save();
                    
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

    public function createModal($userEmail)
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
