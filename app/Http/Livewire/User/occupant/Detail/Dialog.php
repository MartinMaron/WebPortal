<?php

namespace App\Http\Livewire\User\Occupant\Detail;

use Helpers;
use DateTime;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Occupant;
use App\Models\Realestate;
use App\Models\Salutation;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
            'current.date_from_editing'=> 'required|date',
            'current.date_to_editing' => 'nullable',
        ],
        2 => [
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
        ],
        3 => [
            'current.qmkc_editing' => 'nullable',
            'current.uaw' => 'boolean',
            'current.vat' => 'boolean',
            'current.lokalart' => 'nullable',
            'current.customEinheitNo' => 'nullable',
            'current.lage' => 'nullable',
            'current.vorauszahlung_editing' => 'nullable',
            'current.personen_zahl' => 'nullable',      
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
            'current.date_to_editing'=> 'nullable|string',
        ],
        2 => [
            'current.address' => 'nullable',
            'current.street' => 'nullable',
            'current.city' => 'nullable',
            'current.houseNr' => 'nullable',
            'current.postcode' => 'nullable',
        ],
        3 => [
            'current.qmkc_editing' => 'nullable',
            'current.vorauszahlung_editing' => 'nullable',
            'current.uaw' => 'boolean',
            'current.vat' => 'boolean',
            'current.lokalart' => 'nullable',
            'current.customEinheitNo' => 'nullable',
            'current.lage' => 'nullable',
            'current.personen_zahl' => 'nullable',      
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
        if ($this->dialogMode == 'edit'){
           return $this->validationRulesEdit;

        }
        if ($this->dialogMode == 'change'){
           return $this->validationRulesChange;
        }
    }

    protected $listeners = [
        'showOccupantModal' => 'showModal',
        'changeOccupantModal' => 'changeModal',
    ];

    public function rules()
    {
        if ($this->dialogMode == 'change'){
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
        
        $messages = array(
            'current.nachname' => 'bitte geben Sie einen Nachnamen ein',
            'current.date_from_editing' => 'bitte geben Sie ein Datum ein',     
        );
        $calcRules = null;
        if ($this->dialogMode == 'change'){
            $calcRules = $this->validationRulesChange;
        }else
        {
            $calcRules = $this->validationRulesEdit;
        }
        $this->validateOnly($propertyName, $calcRules[$this->currentPage], $messages);
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
        $this->showEditModal = true;
    }

    public function showModal(Occupant $current){
        $this->currentPage = 1;
        $this->resetValidation();
        $this->dialogMode = 'edit';
        $this->current = $current;
        $this->showEditModal = true;
    }

  

    public function closeModal($save){
    
        
        if ($save && $this->current){
            if ($this->validate($this->rules()))
            {
                if($this->dialogMode == 'change')
                {
                    /* Occupant::create($this->current); */
                    $save = Occupant::updateOrcreate(
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
                    
                 }

                if($this->dialogMode == 'edit')
                {
                   $save = Occupant::updateOrcreate(
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
                }
                if(!$save->wasRecentlyCreated && $save->wasChanged()){
                    // updateOrCreate performed an update
                    toast()->success('Die Details des Nutzers wurden geändert.','Achtung')->push();
                    return redirect(request()->header('Referer'));
                }
                
                if(!$save->wasRecentlyCreated && !$save->wasChanged()){
                    // updateOrCreate performed nothing, row did not change
                    $this->showEditModal = false;
                }
                
                if($save->wasRecentlyCreated){
                    toast()->success('Hinzufügen eines neuen Benutzers.','Achtung')->push();
                    return redirect(request()->header('Referer'));
                   // updateOrCreate performed create
                }
                
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
        Debugbar::info('Dialog Occupant-goToNextPage 1 '. $this->dialogMode);
           
        if ($this->dialogMode == 'change'){
            Debugbar::info('Dialog Occupant-goToNextPage 1a '. $this->dialogMode);
            $calcRules = $this->validationRulesChange;
        }else
        {
            Debugbar::info('Dialog Occupant-goToNextPage 1b '. $this->dialogMode);
            $calcRules = $this->validationRulesEdit;
        }
        Debugbar::info('Dialog Occupant-goToNextPage 2 '. $this->dialogMode);
      
        $this->validate($calcRules[$this->currentPage]);
        Debugbar::info('Dialog Occupant-goToNextPage 3 '. $this->dialogMode);
      
        $this->currentPage++;
        Debugbar::info('Dialog Occupant-goToNextPage 4 '. $this->dialogMode);
      
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
