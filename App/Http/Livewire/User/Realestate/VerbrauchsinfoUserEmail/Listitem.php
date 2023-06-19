<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use App\Models\VerbrauchsinfoUserEmail;
use Livewire\Component;

class Listitem extends Component
{
   
    public VerbrauchsinfoUserEmail $userEmail;

    public function mount(VerbrauchsinfoUserEmail $userEmail)
    {
        $this->userEmail = $userEmail;
    }
    
    public function raise_EditModal()
    {
        $this->emit('showUserEmailModal', $this->userEmail);   
    }

    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.listitem');
    }
}
