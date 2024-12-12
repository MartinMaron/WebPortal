<?php

namespace App\Http\Livewire\User\Cost;

use App\Models\Cost;
use Livewire\Component;
use App\Models\CostAmount;
use App\Models\Realestate;
use App\Events\CostAmountDeleted;
use App\Models\Costinvoicingtype;
use App\Models\Costtype;
use App\Models\Occupant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Carbon\Carbon;

use function Termwind\render;

class Heizkostenliste extends Component
{
    use WireToast;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showEditFields = true;
    public $showFilters = false;
    public $nettoInputMode = false;
    public $dateInputMode = true;
    public $dateFrom = null;
    public Cost $current;
    public Realestate $realestate;
    public bool $showDeleteCostAmountModal = false;
    public bool $hasManyBrennstoffkosten = false;

    public function rules()
    {
        return [
            'current.nazwa' => 'required|min:2',
            'current' => 'sometimes',
            'current.dateCostAmount' => 'date|sometimes',
        ];
    }

    /* initialization */
    public function mount($realestate)
    {
        
        $this->realestate = $realestate;
        $this->current = $this->makeBlankObject();
        $this->nettoInputMode = $realestate->eingabeCostNetto;
        $this->dateInputMode = $realestate->eingabeCostDatum;
        $this->showEditFields = !$realestate->heizkostenlisteDone;
        $this->hasManyBrennstoffkosten = (bool)(Cost::where('realestate_id','=',$this->realestate->id)
                                        ->where(function (Builder $query) {$query->IsHeizkosten();})
                                        ->where('costtype_id','=','BRK')
                                        ->count() > 1);
    }

    public function toggle($value)
    {
        if ($value == 'heizkostenlisteDone'){
            $this->realestate->abrechnungssetting->heizkostenlisteDone = 1;
            $this->realestate->abrechnungssetting->save();
            $this->showEditFields = !$this->realestate->abrechnungssetting->heizkostenlisteDone;
            return redirect(request()->header('Referer'));
        }
    }


    public function makeBlankObject()
    {
        return Cost::make([
            'nekoId' => $this->realestate->nekoId,
            'realestate_id' => $this->realestate->id,
            'unvid' => $this->realestate->unvid,
            'budguid' => $this->realestate->nekoId,
            'costtype' => Costtype::find('HNK'),
            'caption' => 'Neue Kostenposition',
        ]);
    }

    protected $listeners = [
                            'changeProperty' => 'changeValue',
                            'refreshComponents' => '$refresh',
                        ];

    public function setCurrent(Cost $cost)
    {
        if ($this->current->isNot($cost)) {
            $this->current = $cost;
        }
    }

    public function raise_EditCostModal(Cost $cost)
    {
        $this->setCurrent($cost);
        if ($cost->costtype->costinvoicingtype_id == 'HZ')
        {
             $this->emit('showCostDetailModal', $this->current, false, false);
        }else 
        {
            $this->emit('showBetriebskostenCostDetailModal', $this->current);
        }
    }

    public function raise_AddCostModal(Cost $costTemplate)
    {
        $this->setCurrent($costTemplate);
        $this->emit('showCostDetailModal', $this->current, true, false);
    }

    public function hasConsumptionByType($costtypeId){
        $ret = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsHeizkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->where('consumption','=', 1)
        ->count();
        return (bool)($ret > 0);
    }
    public function hasHaushaltsnahByType($costtypeId){
        $ret = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsHeizkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->where('haushaltsnah','=', 1)
        ->count();
        return (bool)($ret > 0);
    }

    public function getCostByType($costtypeId){
        return Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsHeizkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->get();
    }

    public function render()
    {
        $costtypes = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsHeizkosten();})
        ->get()->unique('costtype_id')
        ->sortBy('CostTypeSort');

        return view('livewire.user.cost.heizkostenliste', [
            'costtypes' => $costtypes
        ]);
    }
}

