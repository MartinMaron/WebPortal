<?php

namespace App\Http\Livewire;
use App\Models\VerbrauchsinfoCounterMeter;
use App\Models\Occupant;
use Livewire\Component;

class CounterMeterSmall extends Component
{

    public VerbrauchsinfoCounterMeter $singleCounterMeter;
    public Occupant $occupant;

    public function mount($singleCounterMeter,$occupant)
    {
        $this->singleCounterMeter = $singleCounterMeter;
        $this->occupant = $occupant;
    }

    public function render()
    {
        return view('livewire.counter-meter-small');
    }
}
