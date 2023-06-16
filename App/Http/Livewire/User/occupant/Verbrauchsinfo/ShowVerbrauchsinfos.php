<?php

namespace App\Http\Livewire\User\occupant\Verbrauchsinfo;

use Livewire\Component;
use App\Models\Occupant;
use App\Http\Livewire\DataTable\WithCachedRows;

class ShowVerbrauchsinfos extends Component
{
    use WithCachedRows;
    public Occupant $occupant;

    /* initialization */
    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function getRowsQueryProperty()
    {
        $result = $this->occupant->verbrauchsinfos();
        return $result;
    }

    public function getVerbrauchsinfosByNutzergrupe($nutzergrupe_id){
        return $this->rows->where('nutzergrup_id','=',$nutzergrupe_id)
                ->sortBy('ww')
        ;

    }


    public function render()
    {
        $nutzergruppen = $this->rowsQuery
        ->get()->unique('nutzergrup_id');

        return view('livewire.user.occupant.verbrauchsinfo.show-verbrauchsinfos', [
            'rows' => $this->rows,
            'nutzergruppen' => $nutzergruppen,
        ]);
    }
}
