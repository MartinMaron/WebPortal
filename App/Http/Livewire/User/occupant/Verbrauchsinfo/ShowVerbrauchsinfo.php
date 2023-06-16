<?php

namespace App\Http\Livewire\User\Occupant\Verbrauchsinfo;

use Livewire\Component;
use App\Models\Occupant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\DataTable\WithCachedRows;

class ShowVerbrauchsinfo extends Component
{
    use WithCachedRows;

    public $occupants;
    public $filter;

    /* initialization */
    public function mount()
    {


    }
    public function resetFilters()
    {
        $this->reset('filter');
    }

    public function getRowsQueryProperty()
    {
        if ($this->filter) {
            Debugbar::info($this->filter);
            $result = Occupant::query()
                ->where('email', '=', Auth()->User()->email)
                ->where(function (Builder $query) {
                    $query->where('address', 'LIKE', '%' . $this->filter . '%')
                        ->orWhere('lage', 'LIKE', '%' . $this->filter . '%')
                        ->orWhere('unvid', 'LIKE', '%' . $this->filter . '%');
                });

        } else {
            $result = Occupant::query()
            ->where('email', '=', Auth()->User()->email);
        };

        return $result;
    }

    public function getRowsProperty()
    {
         // return $this->cache(function () {
        return $this->rowsQuery->get();
        // });
    }

    public function render()
    {

        return view('livewire.user.occupant.verbrauchsinfo.show-verbrauchsinfo', [
            'rows' => $this->Rows,
        ]);
    }
}
