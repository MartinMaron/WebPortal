<?php

namespace App\Http\Livewire\User\Occupant\OccupantList;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use App\Models\Salutation;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class ShowOccupantList extends Component
{

    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showCustomEinheitNo = true;
    public $hasAnyCustomEinheitNo = false;
    public $hasAnyEigentumer = false;
    public $showEigentumer = true;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public bool $editVorauszahlungen = false;
    public $currentVorauszahlung = 0;
    public $salutations = null;
    public $calendarOff = false;
    public $filters = [
        'search' => '',
    ];

    public $dateFrom = null;

    public Occupant $current;
    public Realestate $realestate;
    public $occupant;

    protected $queryString = ['sorts'];
    // protected $listeners = [c];


    public function Salutations()
    {
    }

    /* initialization */
    public function mount($baseobject)
    {
        $this->realestate = $baseobject;
        $this->hasAnyCustomEinheitNo = (bool) $this->realestate->occupants->where('customEinheitNo', '<>', '')->count();
        $this->hasAnyEigentumer = (bool) $this->realestate->occupants->where('eigentumer', '<>', '')->count();
        $this->salutations = Salutation::all();
        $this->sorts = [
            'customEinheitNo' => 'asc'
            ];
        $this->current = $this->realestate->occupants->first();
    }

    public function toggle($value)
    {
        if ($value = 'filters') {
            $this->useCachedRows();
            $this->showFilters = !$this->showFilters;
        }
        if ($value = 'vorauszahlung') {
            $this->editVorauszahlungen = !$this->editVorauszahlungen;
        }
    }

    public function change(Occupant $occupant)
    {
        $this->setCurrent($occupant);
        $this->emit('changeOccupantModal', $occupant);
    }

    public function setCurrent(Occupant $occupant)
    {
        $this->useCachedRows();
        if ($this->current->isNot($occupant)) {
            $this->current = $occupant;
            $this->currentVorauszahlung = $occupant->vorauszahlung;
        }
    }

    public function edit(Occupant $occupant)
    {
        $this->setCurrent($occupant);
        $this->emit('showOccupantModal', $this->current);
    }

    public function confirmPrePaid(Occupant $occupant, $value)
    {
        $this->useCachedRows();
        if ($this->current->isNot($occupant)) $this->current = $occupant;
    }


    public function save()
    {
        if (!is_null($this->current->dateTo)) {
            $this->current->dateTo = Carbon::parse($this->current->dateTo);
        }
        if (!is_null($this->current->dateFrom)) {
            $this->current->dateFrom = Carbon::parse($this->current->dateFrom);
        }

        $this->validate();
        $this->current->save();
        $this->showEditModal = false;
    }

    public function togleshowCustomEinheitNo(){
        $this->showCustomEinheitNo = !$this->showCustomEinheitNo;
    }

    public function togleshowEigentumer(){
        $this->showEigentumer = !$this->showEigentumer;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        if ($this->filters['search']) {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id)
                ->where(function (Builder $query) {
                    $query->where('address', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('lage', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('customEinheitNo', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('eigentumer', 'LIKE', )
                        ->orWhere('unvid', 'LIKE', '%' . $this->filters['search'] . '%');
                });
        } else {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id);
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

    public function render()
    {

        return view('livewire.user.occupant.occupant-list.show-occupant-list', [
            'rows' => $this->rows,
            'salutations' => $this->salutations(),
            'current' => $this->current,
        ]);
    }
}
