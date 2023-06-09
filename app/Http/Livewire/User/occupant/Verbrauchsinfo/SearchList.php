<?php

namespace App\Http\Livewire\User\Occupant\Verbrauchsinfo;


use Livewire\Component;
use App\Models\Occupant;
use App\Http\Livewire\DataTable\WithCachedRows;

class SearchList extends Component
{

    use WithCachedRows;
    public $occupant;

    /* initialization */
    public function mount($pOccupant)
    {
        dd($pOccupant);
        $this->occupant = $pOccupant;
    }


    public function render()
    {
        return view('livewire.user.occupant.verbrauchsinfo.search-list');
    }
}
