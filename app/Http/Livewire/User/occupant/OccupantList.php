<?php

namespace App\Http\Livewire\User\Occupant;


use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use App\Models\Salutation;
use Livewire\WithPagination;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;


class OccupantList extends Component
{
    use WithPagination;
    

    public $salutations = null;
    public Realestate $realestate; 
    public $filter = [
        'search' => null,
    ];

    /* initialization */
    public function mount($realestate)
    {
      
        $this->realestate = $realestate;
        $this->salutations = Salutation::all();
    }

    public function Salutations()
    {
    }

    public function updatingfilter()
    {
        Debugbar::info($this->filter['search']);
        $this->resetPage();
    }

    public function getRowsQueryProperty()
    {
        if ($this->filter['search']) {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id)
                ->where(function (Builder $query) {
                    $query->where('address', 'LIKE', '%' . $this->filter['search'] . '%')
                        ->orWhere('lage', 'LIKE', '%' . $this->filter['search'] . '%')
                        ->orWhere('unvid', 'LIKE', '%' . $this->filter['search'] . '%');
                });
        } else {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id);
        };
        return $result;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function render()
    {
        Debugbar::info('render');
        
        return view('livewire.user.occupant.occupant-list', [
            'rows' => $this->rows,
            'salutations' => $this->Salutations(),
        ]);
    }

}
