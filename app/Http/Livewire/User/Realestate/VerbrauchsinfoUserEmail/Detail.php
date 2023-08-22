<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;
use DateTime;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;
use App\Models\VerbrauchsinfoUserEmail;
use Usernotnull\Toast\Concerns\WireToast;

class Detail extends Component
{
    use WireToast;

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
            'userEmail.email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'userEmail.firstinitUsername' => 'nullable',
            'userEmail.bis' => 'nullable|date',
            'userEmail.seit' => 'required|date',
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
                    VerbrauchsinfoUserEmail::create($this->userEmail);
                    $this->emit('refreshParent');
                    toast()->success('Emailadresse für Verbraucherinformationen hinzugefügt','Achtung')->push();

                 }
                if($this->dialogMode == 'edit')
                {
                    VerbrauchsinfoUserEmail::updateOrcreate(
                            ['id' => $this->userEmail['id']],
                            ['email' => $this->userEmail['email'],
                            'seit' => $this->userEmail['seit'],
                            'bis' => $this->userEmail['bis'],
                            'firstinitUsername' => $this->userEmail['firstinitUsername'],
                            ]
                            );
                    toast()->success('Emailadresse für Verbraucherinformationen wurde geändert','Achtung')->push();

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
