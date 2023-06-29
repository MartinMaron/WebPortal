<?php

namespace App\Http\Livewire\User\Occupant\CounterMeterReading;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Livewire\DataTable\WithSorting;

class ListHeader extends Component
{

    public $sorts = [];

    public function mount($sorts)
    {
        $this->sorts  = $sorts;
      }

    public function sortByDatum()
    {
        $this->emit('SortByDatum');
    }


    public function render()
    {
        return view('livewire.user.occupant.counter-meter-reading.list-header');
    }
}
