<?php

namespace App\Http\Livewire\User\Occupant\Detail;

use DateTime;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use App\Models\Salutation;
use Barryvdh\Debugbar\Facades\Debugbar;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Helpers;

class Dialog extends Component
{

    public $salutations = null;
    public Realestate $realestate;
    public Occupant $current;
 
    // Form properties
    public $dateFromNewOccupantLeerstand = null;
    public $dateFromNewOccupant = null;
    public $hasLeerstand = false;
    
    public string $qmkc = "";
    public string $pe  = "";
    public string $vorauszahlung = "";
    

    // Dialog properties
    public string $dialogMode = '';
    public bool $showEditModal;

    // MultiViewForm properties
    public $currentPage = 1;
    public $success;
 
    public $pages = [
        1 => [
            'heading' => 'Persönliche Information',
            'subheading' => 'hier können die pesonenbezogenen Daten eingegeben werden.',
        ],
        2 => [
            'heading' => 'Adresse und Anschrift',
            'subheading' => 'Bitte die Daten vervolständigen.',
        ],
        3 => [
            'heading' => 'Eigenschaften der Nutzeinheit',
            'subheading' => 'hier können die Daten der Nutzereinheit verändert werden.',
        ],
        4 => [
            'heading' => 'Zusätzliche Bemerkungen',
            'subheading' => 'es können weitere Bemerkungen eingetragen werden.',
        ],
        5 => [
            'heading' => 'Zählerstände',
            'subheading' => 'Falls ein Wohnungsübergabeprotokoll existiert, bitte hier die Zählerstände angeben.',
        ],
    ];

    private $validationRulesChange = [
        1 => [
            'dateFromNewOccupantLeerstand' => 'nullable|date',
            'dateFromNewOccupant' => 'nullable|date',
            'hasLeerstand' => 'nullable|boolean',
            'current.nachname' => 'required|min:2',
            'current.vorname' => 'nullable',
            'current.anrede' => 'nullable',    
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
            'current.email' => 'nullable|string|email|max:255',
            'current.telephone_number' => 'nullable',
            'current.date_from_editing'=> 'required|string',
            'current.dateTo' => 'nullable',
        ],
        2 => [
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
        ],
        3 => [
            'current.qmkc' => 'nullable',
            'current.pe' => 'nullable',
            'current.uaw' => 'boolean',
            'current.vat' => 'boolean',
            'current.lokalart' => 'nullable',
            'current.customEinheitNo' => 'nullable',
            'current.lage' => 'nullable',
            'current.vorauszahlung' => 'nullable',      
        ],
        4 => [
            'current.bemerkung' => 'nullable',
        ],
        5 => [
            'current.bemerkung' => 'nullable',
        ],        
    ];

    private $validationRulesEdit = [
        1 => [
            'dateFromNewOccupantLeerstand' => 'nullable|date',
            'dateFromNewOccupant' => 'nullable|date',
            'hasLeerstand' => 'nullable|boolean',
            'current.nachname' => 'required|min:2',
            'current.vorname' => 'nullable',
            'current.anrede' => 'nullable',    
            'current.email' => 'nullable|string|email|max:255',
            'current.telephone_number' => 'nullable', 
            'current.date_from_editing'=> 'required|string',
        ],
        2 => [
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
        ],
        3 => [
            'qmkc' => 'nullable',
            'pe' => 'nullable',
            'current.uaw' => 'boolean',
            'current.vat' => 'boolean',
            'current.lokalart' => 'nullable',
            'current.customEinheitNo' => 'nullable',
            'current.lage' => 'nullable',
            'vorauszahlung' => 'nullable',      
        ],
        4 => [
            'current.bemerkung' => 'nullable',
        ],
        5 => [
            'current.bemerkung' => 'nullable',
        ],
    ];

  
    public function ValidationRules()
    {
        if ($this->dialogMode = 'edit'){
           return $this->validationRulesEdit;

        }
        if ($this->dialogMode = 'change'){
           return $this->validationRulesChange;
        }
    }

    protected $listeners = [
        'showOccupantModal' => 'showModal',
        'changeOccupantModal' => 'changeModal',
    ];

    public function rules()
    {
        if ($this->dialogMode = 'change'){
            return collect($this->validationRulesChange)->collapse()->toArray();
        }else
        {
            return collect($this->validationRulesEdit)->collapse()->toArray();
        }
    }

    /* initialization */
    public function mount(Realestate $realestate, $current = null)
    {
        $this->realestate = $realestate;
        if ($current != null) {
            $this->current = $current;
        } else {
            $this->current = $this->realestate->occupants->first();
        }
        $this->salutations = Salutation::all();
    }



    public function updated($propertyName)
    {
        Debugbar::info('Dialog Occupant-updated:'. $propertyName);
        
        $messages = array(
            'current.nachname' => 'bitte geben Sie einen Nachnamen ein',
            'current.date_from_editing' => 'bitte geben Sie ein Datum ein',     
        );
        
        $calcRules = null;
        if ($this->dialogMode = 'change'){
            $calcRules = $this->validationRulesChange;
        }else
        {
            $calcRules = $this->validationRulesEdit;
        }

     
        $this->validateOnly($propertyName, $calcRules[$this->currentPage], $messages);

        Debugbar::info('Dialog Occupant-updated: end'. $propertyName);
        
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
        
        $this->currentPage = 1;
        $this->resetValidation();
        $this->dialogMode = 'change';
        $this->current = $this->makeNewOccupant($current);
        $this->assignCastableValues($current);
        $this->showEditModal = true;
    }

    protected function assignCastableValues(Occupant $occupant)
    {
        $this->vorauszahlung = $this->current->vorauszahlung_editing;    
        $this->qmkc = $this->current->qmkc_editing;    
        $this->pe = $this->current->personen_zahl;   
        /* $this->dateTo = $this->current->date_to_editing;   
        $this->dateFrom = $this->current->date_from_editing;   */          
    }

    protected function assignBackCastableValues(Occupant $occupant)
    {
        $occupant->vorauszahlung_editing = $this->vorauszahlung;    
        $occupant->qmkc_editing = $this->qmkc;    
        $occupant->personen_zahl = $this->pe;   
        $occupant->date_to_editing = $this->dateTo;   
        $occupant->date_from_editing = $this->dateFrom;            
    }

    public function showModal(Occupant $current){
        $this->currentPage = 1;
        $this->resetValidation();
        $this->dialogMode = 'edit';
        $this->current = $current;
        $this->assignCastableValues($current);
        $this->showEditModal = true;
    }

  

    public function closeModal($save){
    
        
        if ($save && $this->current){
            $this->assignBackCastableValues($this->current);
            if ($this->validate($this->rules()))
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
                    toast()->success('Hinzufügen eines neuen Benutzers','Achtung')->push();
                    $this->emit('refreshParent');   
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
                    toast()->success('Die Details des neuen Nutzers wurden geändert.','Achtung')->push();
                }
             
                $this->showEditModal = false ;
            
            }else{
                $this->showEditModal = true;
            };
        }else{
            $this->showEditModal = false;
        }

    }


    public function goToNextPage()
    {
        $calcRules = null;
        if ($dialogMode = 'change'){
            $calcRules = $this->validationRulesChange;
        }else
        {
            $calcRules = $this->validationRulesEdit;
        }
        $this->validate($calcRules[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    public function resetSuccess()
    {
        $this->reset('success');
    }

    public function setCurrent(Occupant $occupant)
    {
        $this->useCachedRows();
        if ($this->current->isNot($occupant)) {
            $this->current = $occupant;
            
        }
    }
 
    public function render()
    {
       /*  return view('livewire.user.occupant.detail.dialog',[
            'current' => $this->current,
        ]); */
        return view('livewire.user.occupant.detail.dialog');

    }
}
