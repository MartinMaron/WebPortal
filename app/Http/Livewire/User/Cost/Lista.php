<?php

namespace App\Http\Livewire\User\Cost;

use App\Models\Cost;
use Livewire\Component;
use App\Models\CostAmount;
use App\Models\Realestate;
use App\Events\CostAmountDeleted;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use Usernotnull\Toast\Concerns\WireToast;

use function Termwind\render;

class Lista extends Component
{
    use WireToast;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showEditFields = true;
    public $showFilters = false;
    public $nettoInputMode = false;
    public $dateInputMode = true;

    public $currentCostAmount = null;

    public $dateFrom = null;

    public Cost $current;
    public Realestate $realestate;
    public bool $showDeleteCostAmountModal = false;
    public bool $hasManyBrennstoffkosten = false;
    public int $costIndex = 0;

    public function getCostIndex(){
        $this->costIndex++;
        return $this->costIndex;
    }

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
        $this->showEditFields = $realestate->kosteneingabe;
        $this->hasManyBrennstoffkosten = (bool)(Cost::where('realestate_id','=',$this->realestate->id)
                                        ->where(function (Builder $query) {$query->IsHeizkosten();})
                                        ->where('costtype_id','=','BRK')
                                        ->count() > 1);
    }

    public function makeBlankObject()
    {
        return Cost::make([
            'nekoId' => $this->realestate->nekoId,
            'realestate_id' => $this->realestate->id,
            'unvid' => $this->realestate->unvid,
            'budguid' => $this->realestate->nekoId,
            'caption' => 'Nowy',
        ]);
    }

    protected $listeners = [
                            'changeProperty' => 'changeValue',
                            'refreshComponents' => '$refresh',
                            'deleteCostAmount' => 'questionDeleteCostAmount',
                            'showCostAmountDetailInListaModal' => 'raise_EditCostAmountModal',
                        ];


    public function togleShowEditFields(){
        $this->showEditFields = !$this->showEditFields;
        $this->realestate->kosteneingabe = $this->showEditFields;
        $this->realestate->save();
    }

    public function create()
    {
        if ($this->current->getKey()) $this->current = $this->makeBlankTransaction();
        $this->showEditModal = true;
    }

    public function setCurrent(Cost $cost)
    {
        if ($this->current->isNot($cost)) {
            $this->current = $cost;
        }
    }

    public function raise_EditCostModal(Cost $cost)
    {
        $this->setCurrent($cost);
        $this->emit('showCostDetailModal', $this->current, false, false);
    }

    public function raise_AddCostModal(Cost $costTemplate)
    {
        $this->setCurrent($costTemplate);
        $this->emit('showCostDetailModal', $this->current, true, false);
    }

    public function raise_EditCostConsumptionModal(Cost $cost)
    {
        $this->setCurrent($cost);
        $this->emit('showCostDetailModal', $this->current, false, true);
    }


    public function editCostAmountModal(CostAmount $costAmount)
    {
        $this->emit('showCostAmountDetailModal', $costAmount);
    }

    public function questionDeleteCostAmount(CostAmount $costAmount)
    {
        $this->currentCostAmount = $costAmount;
        $this->showDeleteCostAmountModal = true;
    }

    public function deleteCostAmountModal() {
        $this->showDeleteCostAmountModal = false;
        $this->currentCostAmount->delete();
    }

    public function getCostByType($costtypeId){
        return Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsBrennstoffkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->get();
    }

    public function hasConsumptionByType($costtypeId){
      
        $ret = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsBrennstoffkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->where('consumption','=', 1)
        ->count();
        return (bool)($ret > 0);
    }

    public function hasHaushaltsnahByType($costtypeId){
        $ret = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsBrennstoffkosten();})
        ->where('costtype_id','=',$costtypeId)
        ->where('haushaltsnah','=', 1)
        ->count();
        return (bool)($ret > 0);
        // return $ret;
    }

    public function render()
    {
        $this->costIndex = 0;
        $filtered = Cost::where('realestate_id','=',$this->realestate->id)
        ->where(function (Builder $query) {$query->IsBrennstoffkosten();})
        ->get()->unique('costtype_id')
        ->sortBy('CostTypeSort');

        $filtered->fresh('costAmounts');

        return view('livewire.user.cost.lista', [
            'filtered' => $filtered
        ]);
    }
}
