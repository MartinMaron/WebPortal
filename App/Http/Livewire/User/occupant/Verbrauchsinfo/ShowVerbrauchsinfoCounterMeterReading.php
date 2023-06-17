<?php

namespace App\Http\Livewire\User\occupant\Verbrauchsinfo;

use App\Http\Livewire\DataTable\WithSorting;
use Livewire\Component;
use App\Models\Occupant;
use Illuminate\Support\Facades\App;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;

class ShowVerbrauchsinfoCounterMeterReading extends Component
{
    
    use WithSorting;


    public $neko_id;
    public Occupant $occupant;
  
    /* initialization */
    public function mount(Occupant $occupant, $neko_id)
    {
        $this->neko_id = $neko_id;
        $this->occupant = $occupant;
        $this->sorts = ['datum' => 'desc'];
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function getRowsQueryProperty()
    {
        $result = $this->occupant->counterMeters()
            ->where('nekoId', '=', $this->neko_id);

        return $this->applySorting($result);
    }

    public function render()
    {
        return view('livewire.user.occupant.verbrauchsinfo.show-verbrauchsinfo-counter-meter-reading', [
            'rows' => $this->rows,
        ]);
    }
}
