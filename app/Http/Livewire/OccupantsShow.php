<?php

namespace App\Http\Livewire;
use App\Models\Occupant;
use Livewire\Component;

class OccupantsShow extends Component
{

    public $occupant;


    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
    }


    public function render()
    {
        return view('livewire.occupants-show');
    }
}
