<?php

namespace app\Http\Livewire\User\Occupant;
use App\Models\Occupant;
use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;



class OccupantHeader extends Component
{

    public $occupant;


    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
    }


    public function render()
    {
        return view('livewire.user.occupant.occupant-header');
    }
}
