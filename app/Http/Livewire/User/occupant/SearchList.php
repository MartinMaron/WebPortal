<?php

namespace app\Http\Livewire\User\Occupant;

use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\ComponentConcerns\RendersLivewireComponents;
use Symfony\Component\ErrorHandler\Debug;

class SearchList extends Component
{
    use WithSorting;


        public Occupant $editing;
        public $realestate = null;
        public $showEditModal = true;
        public $editVorauszahlungen = false;


        public function makeBlankOccupant()
        {
            return Occupant::make(['dateFrom' => now(), 'dateTo' => now()]);
        }

        public function mount($realestate) {
            $this->realestate = $realestate;
            $this->editing = $this->makeBlankOccupant();
        }

        public function toggleEditVorauszahlungen()
        {
            $this->editVorauszahlungen = ! $this->editVorauszahlungen;
        }


        public $filter = [
            'search' => null,
        ];

        public function edit(Occupant $occupant)
        {
            if ($this->editing->isNot($occupant)) $this->editing = $occupant;

            $this->showEditModal = true;

        }

        public function save()
        {
            // $this->validate();

            $this->editing->save();

            $this->showEditModal = false;
        }
        public function rules() { return [
            'editing.nachname' => 'required|min:2',
            'editing.vorauszahlung' => 'nullable',
            // 'current.status' => 'required|in:'.collect(Transaction::STATUSES)->keys()->implode(','),
            // 'current.date_for_current' => 'required',
        ]; }

        public function setCurrent(Occupant $occupant)
        {
            Debugbar::info('set current:' . $occupant->nachname);

            if ($this->editing->isNot($occupant)) {
                $this->editing = $occupant;
            }
        }
        public function confirmPrePaid()
        {
            $this->editing->save();
        }

        /*    public function mount($realestate)
        {
            $this->realestate = $realestate;
            $this->$editing = $this-> makeBlankOccupant();
        } */

        public function updatingfilter()
        {
            // $this->resetPage();
        }

        public function render()
        {

            if($this->filter['search'])
            {
                $filtered = Occupant::where('realestate_id','=',$this->realestate->id)
                                ->where(function (Builder $query){
                                    $query->where('address','LIKE','%'. $this->filter['search'].'%')
                                    ->orWhere('lage','LIKE','%'. $this->filter['search'].'%')
                                    ->orWhere('unvid','LIKE','%'. $this->filter['search'].'%');
                                })->paginate(10);

            } else {
                $filtered = Occupant::where('realestate_id','=',$this->realestate->id)->get();

            };
            return view('livewire.user.occupant.search-list',compact('filtered'));
        }

}
