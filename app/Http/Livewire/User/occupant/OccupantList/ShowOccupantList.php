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

    protected $queryString = ['sorts'];
    // protected $listeners = [c];


    public function Salutations()
    {
    }

    public function rules()
    {
        return [
            'current.nachname' => 'required|min:2',
            'current.vorname' => 'sometimes',
            'current.anrede' => 'nullable',
            'current.nekoId' => 'required',
            'current.budguid' => 'required',
            'current.unvid' => 'required',
            'current.nutzeinheitNo' => 'required',
            'current.realestate_id' => 'required',
            'current.qmkc' => 'nullable',
            'current.pe' => 'nullable',
            'current.vorauszahlung' => 'nullable',
            'current.date_to_editing' => 'nullable',
            'current.date_from_editing' => 'nullable',
            'current.uaw' => 'boolean',
            'current.vat' => 'boolean',
            'current.dateFrom' => 'required|date',
            'current.dateTo' => 'nullable',
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
            'current.bemerkung' => 'nullable',
            'current.vorauszahlung' => 'nullable',
            'current.vorauszahlung_editing' => 'nullable',
            'current.lokalart' => 'nullable',
            'current.customEinheitNo' => 'nullable',
            'current.lage' => 'nullable',
            'current.qmkc_editing' => 'nullable',
            'current.email' => 'required|string|email|max:255',
            'current.telephone_number' => 'nullable',


        ];
    }

    /* initialization */
    public function mount($baseobject)
    {
        $this->realestate = $baseobject;
        $this->current = $this->makeBlankObject();
        $this->salutations = Salutation::all();
        $this->sorts = [
            'customEinheitNo' => 'asc',
            'nr' => 'asc'
            ];
    }

    public function makeBlankObject()
    {
        return Occupant::make([
            'nekoId' => $this->realestate->nekoId,
            'realestate_id' => $this->realestate->id,
            'unvid' => $this->realestate->unvid,
            'budguid' => $this->realestate->nekoId,
            'nutzeinheitNo' => 1,

        ]);
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

    public function create()
    {
        $this->useCachedRows();
        if ($this->current->getKey()) $this->current = $this->makeBlankTransaction();
        $this->showEditModal = true;
    }

    public function setCurrent(Occupant $occupant)
    {
        $this->useCachedRows();
        if ($this->current->isNot($occupant)) {
            $this->current = $occupant;
            $this->currentVorauszahlung = $occupant->vorauszahlung;
        }
    }

    public function createOccupantListModal(){
        $this->curren= $this->makeBlankObject();
        $this->curren->occupant = $occupant;
        $this->emit('createOccupantListModal', $this->current);
    }

    public function edit(Occupant $occupant)
    {
        // dd($occupant);
        $this->setCurrent($occupant);
        // $this->useCachedRows();
        // $this->showEditModal = true;
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

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function togleshowCustomEinheitNo(){
        $this->showCustomEinheitNo = !$this->showCustomEinheitNo;
    }

    public function togleshowEigentumer(){
        $this->showEigentumer = !$this->showEigentumer;
    }

    public function a(Occupant $occupant)
    {
        if ($this->showCustomEinheitNo){
            return $occupant->customEinheitNoMitLage;
        }
        else
        {
            return $occupant->nutzerMitLage;
        }
    }

    public function b(Occupant $occupant)
    {
        if ($this->showEigentumer){
            return $occupant->nachname;
        }
        else
        {
            return $occupant->eigentumer;
        }
    }

    public function getRowsQueryProperty()
    {
        if ($this->filters['search']) {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id)
                ->where(function (Builder $query) {
                    $query->where('address', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('lage', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('unvid', 'LIKE', '%' . $this->filters['search'] . '%');
                });
        } else {
            $result = Occupant::query()
                ->where('realestate_id', '=', $this->realestate->id);
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
        return view('livewire.user.occupant.occupant-list.show-occupant-list', [
            'rows' => $this->rows,
            'salutations' => $this->Salutations(),
        ]);
    }
}
