<?php

namespace app\Http\Livewire\User\Occupant\Verbrauchsinfo;

use Livewire\Component;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\Occupant;
use App\Models\Verbrauchsinfo;

class OccupantView extends Component
{
    use WithCachedRows;
    public $occupant;

    /* initialization */
    public function mount(Occupant $pOccupant)
    {
        $this->occupant = $pOccupant;
    }



    public function render()
    {
        $datumYear = date("Y", time());
        $datumMonth =  intval(date("m", time()));
        $datumCrit = $datumYear. '-'. rtrim($datumMonth, '0') ;
        $result = $this->occupant->verbrauchsinfos->where('jahr_monat', '=', $datumCrit) ;

        return view('livewire.user.occupant.verbrauchsinfo.occupant-view', [
            'rows' => $result,
        ]);
    }
}
