<?php

namespace App\Http\Livewire\User\Occupant\CounterMeterReading;
use App\Http\Livewire\DataTable\WithSorting;
use Livewire\Component;

class ListHeader extends Component
{

    public function sortBy(string $field)
    {
      $this->emit('SortByDatum',$field);

    }


    public function render()
    {
        return view('livewire.user.occupant.counter-meter-reading.list-header');
    }
}
