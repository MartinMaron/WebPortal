<?php

namespace App\Http\Livewire;
use App\Models\Verbrauchsinfo;
use Livewire\Component;

class VebrauchsinfoSmallScreen extends Component
{

    public $singleVerbrauchsinfo;


    public function mount(Verbrauchsinfo $singleVerbrauchsinfo)
    {
        $this->verbrauchsinfo = $singleVerbrauchsinfo;
    }


    public function render()
    {
        return view('livewire.vebrauchsinfo-small-screen');
    }
}
