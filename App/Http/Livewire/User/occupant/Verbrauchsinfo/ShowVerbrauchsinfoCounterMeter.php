<?php

namespace App\Http\Livewire\User\occupant\Verbrauchsinfo;

use Livewire\Component;
use App\Models\Occupant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use app\Models\VerbrauchsinfoCounterMeter;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithSorting;


class ShowVerbrauchsinfoCounterMeter extends Component
{

    use WithCachedRows, WithSorting;

    public Occupant $occupant;
    public VerbrauchsinfoCounterMeter $counterMeters;
    public $filter;
    public String $jahr_monat;
    use WithSorting;

    /* initialization */
    public function mount(Occupant $occupant, String $jahr_monat)
    {
         $this->occupant = $occupant;
         $this->jahr_monat = $jahr_monat;
         $this->sorts = [
            'hk' => 'desc',
            'nr' => 'asc'
            ];
        }


    public function checkIfShowFunknr($nutzergrupe_id)
    {
        $query = $this->getCounterMetersByNutzergrupe($nutzergrupe_id)
        ->where(function (Builder $query) {$query->scopeNrFunknrEquals();});
    }

    public function resetFilters()
    {
        $this->reset('filter');
    }

    public function getRowsQueryProperty()
    {
        if ($this->filter) {
            Debugbar::info($this->filter);
            $result = $this->occupant->counterMeters()
                ->where('jahr_monat', '=', $this->jahr_monat)
                ->where(function (Builder $query) {
                    $query->where('nr', 'LIKE', '%' . $this->filter . '%')
                        ->orWhere('funkNr', 'LIKE', '%' . $this->filter . '%');
                });

        } else {
            $result = $this->occupant->counterMeters()
                ->where('jahr_monat', '=', $this->jahr_monat);
        };

        $this->applySorting($result);
        return $result;
    }

    public function getRowsProperty()
    {
         // return $this->cache(function () {
        return $this->rowsQuery->get();
        // });
    }


    public function getCounterMetersByNutzergrupe($nutzergrupe_id){
        return $this->rows->where('nutzergrup_id','=',$nutzergrupe_id)
                ->sortBy('hk')
        ;
    }


    public function render()
    {
        $nutzergruppen = $this->rowsQuery
        ->get()->unique('nutzergrup_id');
        ;



        return view('livewire.user.occupant.verbrauchsinfo.show-verbrauchsinfo-counter-meter', [
            'rows' => $this->rows,
            'nutzergruppen' => $nutzergruppen,
        ]);
    }
}
