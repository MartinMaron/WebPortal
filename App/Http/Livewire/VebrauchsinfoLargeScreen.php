<?php

namespace App\Http\Livewire;
use App\Models\Verbrauchsinfo;
use Livewire\Component;

class VebrauchsinfoLargeScreen extends Component
{

    public $verbrauchsinfo;


    public function mount(Verbrauchsinfo $verbrauchsinfo)
    {
        $this->verbrauchsinfo = $verbrauchsinfo;
    }

    public function render()
    {
        return view('livewire.vebrauchsinfo-large-screen');
    }
}
