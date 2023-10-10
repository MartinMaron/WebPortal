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
use Aws\ManagedBlockchain\Exception\ManagedBlockchainException;

class Dialog extends Component
{

        use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

        public $showCustomEinheitNo = true;
        public $showEigentumer = true;
        public $showDeleteModal = false;
        public $showEditModal = false;
        public $dateFromNewOccupantLeerstand = null;
        public $dateFromNewOccupant = null;
        public $hasLeerstand = false;
        public $showFilters = false;
        public bool $editVorauszahlungen = false;
        public $currentVorauszahlung = 0;
        public $salutations = null;
        public string $dialogMode = '';
        public $calendarOff = false;
        public $filters = [
            'search' => '',
        ];

        public $dateFrom = null;

        public Occupant $current;
        public Realestate $realestate;

        protected $queryString = ['sorts'];
        // protected $listeners = [c];

        protected $listeners = [
            'showOccupantModal' => 'showModal',
            'closeOccupantListModal' => 'closeModal',
            'changeOccupantModal' => 'changeModal',
        ];

        public function rules()
        {
            return [
                'dateFromNewOccupantLeerstand' => 'nullable',
                'dateFromNewOccupant' => 'required|date',
                'hasLeerstand' => 'boolean',
                'current.nachname' => 'required|min:2',
                'current.vorname' => 'nullable',
                'current.anrede' => 'nullable',
                'current.nekoId' => 'required',
                'current.budguid' => 'required',
                'current.unvid' => 'required',
                'current.nutzeinheitNo' => 'required',
                'current.realestate_id' => 'required',
                'current.qmkc' => 'nullable',
                'current.pe' => 'nullable',
                'current.vorauszahlung' => 'nullable',
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
                'current.email' => 'nullable|string|email|max:255',
                'current.telephone_number' => 'nullable',


            ];
        }
        /* initialization */
        public function mount(Realestate $realestate)
        {
            $this->realestate = $realestate;
            $this->salutations = Salutation::all();
            $this->current = $this->realestate->occupants->first();
        }

        public function makeNewOccupant($oldOccupant)
        {
            return Occupant::make([
            'nekoId' => $this->realestate->nekoId,
            'realestate_id' => $this->realestate->id,
            'unvid' => $this->realestate->unvid,
            'budguid' => $this->realestate->nekoId,
            'nutzeinheitNo' => $oldOccupant->nutzeinheitNo,
            'anrede' => $oldOccupant->anrede,
            'title' => $oldOccupant->title,
            'nachname' => "Neuer Nutzer",
            'vorname' => "",
            'address' => $oldOccupant->address,
            'street' => $oldOccupant->street,
            'postcode' => $oldOccupant->postcode,
            'houseNr' => $oldOccupant->houseNr,
            'city' => $oldOccupant->city,
            'vat' => $oldOccupant->vat,
            'uaw' => $oldOccupant->uaw,
            'qmkc' => $oldOccupant->qmkc,
            'qmww' => $oldOccupant->qmww,
            'pe' => $oldOccupant->pe,
            'bemerkung' => $oldOccupant->bemerkung,
            'vorauszahlung' => $oldOccupant->vorauszahlung,
            'lokalart' => $oldOccupant->lokalart,
            'customEinheitNo' => $oldOccupant->customEinheitNo,
            'lage' => $oldOccupant->lage,
            'email' => $oldOccupant->email,
            'telephone_number' => $oldOccupant->telephone_number,
            'eigentumer' => $oldOccupant->eigentumer,
            'dateFrom' => $oldOccupant->dateFrom,
            ]);
        }

        public function changeModal(Occupant $current){
            $this->dialogMode = 'change';
            $this->current = $this->makeNewOccupant($current);
            $this->showEditModal = true;
        }

        public function showModal(Occupant $current){
            $this->dialogMode = 'edit';
            $this->current = $current;
            $this->showEditModal = true;
        }


    public function closeModal($save){
        
        if ($save && $this->current){
            if ($this->validate())
            {
                if($this->dialogMode == 'change')
                {
                
                    /* Occupant::create($this->current); */
                    Occupant::updateOrcreate(
                        ['id' => $this->current['id']],
                        ['nekoId' => $this->current['nekoId'],
                         'realestate_id' => $this->current['realestate_id'],
                         'unvid' => $this->current['unvid'],
                         'budguid' => $this->current['budguid'],
                         'nutzeinheitNo' => $this->current['nutzeinheitNo'],
                         'dateFrom' => $this->current['dateFrom'],
                         'dateTo' => $this->current['dateTo'],
                         'anrede' => $this->current['anrede'],
                         'title' => $this->current['title'],
                         'nachname' => $this->current['nachname'],
                         'vorname' => $this->current['vorname'],
                         'address' => $this->current['address'],
                         'street' => $this->current['street'],
                         'postcode' => $this->current['postcode'],
                         'houseNr' => $this->current['houseNr'],
                         'city' => $this->current['city'],
                         'vat' => $this->current['vat'],
                         'uaw' => $this->current['uaw'],
                         'qmkc' => $this->current['qmkc'],
                         'qmww' => $this->current['qmww'],
                         'pe' => $this->current['pe'],
                         'bemerkung' => $this->current['bemerkung'],
                         'vorauszahlung' => $this->current['vorauszahlung'],
                         'lokalart' => $this->current['lokalart'],
                         'customEinheitNo' => $this->current['customEinheitNo'],
                         'lage' => $this->current['lage'],
                         'email' => $this->current['email'],
                         'telephone_number' => $this->current['telephone_number'],
                         'eigentumer' => $this->current['eigentumer'],
                        ]
                    );
                    $this->emit('refreshParent');
                    toast()->success('Hinzufügen eines neuen Benutzers','Achtung')->push();
                }
                if($this->dialogMode == 'edit')
                {
                    Occupant::updateOrcreate(
                        ['id' => $this->current['id']],
                        ['nekoId' => $this->current['nekoId'],
                         'realestate_id' => $this->current['realestate_id'],
                         'unvid' => $this->current['unvid'],
                         'budguid' => $this->current['budguid'],
                         'nutzeinheitNo' => $this->current['nutzeinheitNo'],
                         'dateFrom' => $this->current['dateFrom'],
                         'dateTo' => $this->current['dateTo'],
                         'anrede' => $this->current['anrede'],
                         'title' => $this->current['title'],
                         'nachname' => $this->current['nachname'],
                         'vorname' => $this->current['vorname'],
                         'address' => $this->current['address'],
                         'street' => $this->current['street'],
                         'postcode' => $this->current['postcode'],
                         'houseNr' => $this->current['houseNr'],
                         'city' => $this->current['city'],
                         'vat' => $this->current['vat'],
                         'uaw' => $this->current['uaw'],
                         'qmkc' => $this->current['qmkc'],
                         'qmww' => $this->current['qmww'],
                         'pe' => $this->current['pe'],
                         'bemerkung' => $this->current['bemerkung'],
                         'vorauszahlung' => $this->current['vorauszahlung'],
                         'lokalart' => $this->current['lokalart'],
                         'customEinheitNo' => $this->current['customEinheitNo'],
                         'lage' => $this->current['lage'],
                         'email' => $this->current['email'],
                         'telephone_number' => $this->current['telephone_number'],
                         'eigentumer' => $this->current['eigentumer'],
                        ]
                    );
                toast()->success('Die Details des neuen Mandanten wurden geändert.','Achtung')->push();
                }
                    $this->emit('refreshParent');
                    $this->showEditModal = false ;
                }else{
                    $this->showEditModal = true;
                };
            }else{
                $this->showEditModal = false;
            }

        }


        public function create(Occupant $occupant)
        {
            $this->useCachedRows();
            $this->current = $this->makeBlankObject($occupant);
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

        public function edit(Occupant $occupant)
        {
            $this->useCachedRows();
            $this->setCurrent($occupant);
            $this->showEditModal = true;
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
            //Sortowanie
        }

        public function togleshowEigentumer(){
            $this->showEigentumer = !$this->showEigentumer;
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
            {
                return view('livewire.user.occupant.occupant-list.dialog');
            }
        }

}
