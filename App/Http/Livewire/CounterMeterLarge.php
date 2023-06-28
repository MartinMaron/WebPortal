<?php

namespace App\Http\Livewire;
use App\Models\VerbrauchsinfoCounterMeter;
use Livewire\Component;

class CounterMeterLarge extends Component
{

    public $counterMeter;


    public function mount(VerbrauchsinfoCounterMeter $counterMeter)
    {
        $this->counterMeter = $counterMeter;
    }

    public function render()
    {
        return view('livewire.counter-meter-large');
    }
}
