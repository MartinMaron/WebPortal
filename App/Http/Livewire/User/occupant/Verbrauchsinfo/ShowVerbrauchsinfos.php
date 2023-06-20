<?php

namespace App\Http\Livewire\User\occupant\Verbrauchsinfo;

use Livewire\Component;
use App\Models\Occupant;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithSorting;

class ShowVerbrauchsinfos extends Component
{
    use WithCachedRows, WithSorting;
    public Occupant $occupant;

    /* initialization */
    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
        $this->sorts = [
            'hk' => 'desc',
            'datum' => 'desc'
            ];
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function getRowsQueryProperty()
    {
        $result = $this->occupant->verbrauchsinfos();
        $this->applySorting($result);
        return $result;
    }

    public function getVerbrauchsinfosByNutzergrupe($nutzergrupe_id){
        return $this->rows->where('nutzergrup_id','=',$nutzergrupe_id)
        ;
    }


    public function render()
    {
        $nutzergruppen = $this->rowsQuery
        ->orderBy('ww')
        ->get()->unique('nutzergrup_id');

        return view('livewire.user.occupant.verbrauchsinfo.show-verbrauchsinfos', [
            'rows' => $this->rows,
            'nutzergruppen' => $nutzergruppen,
        ]);
    }
}
