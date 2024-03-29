<?php

namespace App\Http\Livewire\User\Occupant\OccupantList;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use App\Models\Salutation;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\UserVerbrauchsinfoAccessControl;

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

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteConfirmed' => 'delete',        
    ];

    public function delete($objectId, $objectType)
    {
        if ($objectType != 'Occupant') return;
        $object = Occupant::find($objectId);


        /* der Zeitraum des letzen Nutzers wird wieder aufgemacht */
        $last_occupant = $object->realestate->occupants
                            ->where('nutzeinheitNo', $object->nutzeinheitNo)
                            ->where('unvid','!=', $object->unvid)
                            ->sortBy('dateFrom')->last();
        $last_occupant->dateTo = null;
        $last_occupant->save();              

        /* userEmails öffnen */
        $q = $last_occupant->realestate->verbrauchsinfoUserEmails->
            where('nutzeinheitNo', '=', $object->nutzeinheitNo)
            ->where('dateTo',(new carbon($object->dateFrom))->addDay(-1));

        foreach ($q as $userEmail) {
            $userEmail->dateTo = null;
            $userEmail->save();
            /* TODO: berechtigungen anpassen */
            /* schleife über die letzen 13 Monate und schauen userVerbrauchsinfoAccessControls neu angelegt werden müssen   */ 
            /* $last_occupant->userVerbrauchsinfoAccessControls */
            $occupantUser = User::where('email', $userEmail->email)->firstOrFail();
            for($i=0; $i < 12; $i++) {
                $jahr_monat = carbon::now()->addMonth(0-$i)->isoFormat('YYYY-M');
                $qAccContr = $last_occupant->userVerbrauchsinfoAccessControls->where('jahr_monat', $jahr_monat)
                                                                ->where('user_id', $occupantUser->id);

                if ($qAccContr->count() == 0){
                    UserVerbrauchsinfoAccessControl::updateOrcreate(
                        ['jahr_monat' => $jahr_monat, 'user_id' => $occupantUser->id,'occupant_id' => $last_occupant->id],
                        [
                            'neko_id' => 0,
                            'toWebDelete' => true,
                        ]
                    );  
                }                                                
            } 
        } 
    



        $object->delete();
        toast()->success('Nutzer wurde gelöscht','Achtung')->push();
        return redirect(request()->header('Referer'));
    }

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
            'unvid' => 'asc'
            ];
        $this->current = $this->realestate->occupants->first();
        $this->showCustomEinheitNo = $this->realestate->occupant_number_mode;
        $this->showEigentumer = $this->realestate->occupant_name_mode;
    }

    public function toggle($value)
    {
        if ($value == 'filters') {
            $this->useCachedRows();
            $this->showFilters = !$this->showFilters;
        }
        if ($value == 'vorauszahlung') {
            $this->editVorauszahlungen = !$this->editVorauszahlungen;
        }
        if ($value == 'nummer'){
            $this->showCustomEinheitNo = !$this->showCustomEinheitNo;
            $this->realestate->occupant_number_mode = $this->showCustomEinheitNo;
            $this->realestate->save();
        }
        if ($value == 'eigentumer'){
            $this->showEigentumer = !$this->showEigentumer;
            $this->realestate->occupant_name_mode = $this->showEigentumer;
            $this->realestate->save();
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
                        ->orWhere('eigentumer', 'LIKE', '%' . $this->filters['search'] . '%' )
                        ->orWhere('nachname', 'LIKE', '%' . $this->filters['search'] . '%' )
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

    public function emit_QuestionDeleteModal(Occupant $id)
    {
        $this->emit('showQuestionDeleteModal', 'Occupant', $id->id, 'Löschen bestätigen', 'Wollen Sie den Nutzer '.  $id->nachname .  ' entfernen?');
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
