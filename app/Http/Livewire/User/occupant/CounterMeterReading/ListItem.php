<?php

namespace App\Http\Livewire\User\Occupant\CounterMeterReading;
use App\Models\VerbrauchsinfoCounterMeter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ListItem extends Component
{

    public $counterMeter;

    public function mount(VerbrauchsinfoCounterMeter $counterMeter): void
    {
        $this->counterMeter = $counterMeter;
    }

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.user.occupant.counter-meter-reading.listitem');
    }
}
