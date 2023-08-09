<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;


class PdfDownload extends Component
{
    public function render()
    {
        return view('livewire.user.realestate.verbrauchsinfo-user-email.pdf-download');
    }
}
