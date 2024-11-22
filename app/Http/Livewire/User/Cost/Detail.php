<?php

namespace App\Http\Livewire\User\Cost;
use App\Models\Cost;
use Livewire\Component;
use App\Models\CostType;
use App\Models\FuelType;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Builder;



class Detail extends Component
{
    use WireToast; 
    public $cost = null;
    public $showEditModal = false;
    public $costTypes = null;
    public $fuelTypes = null;
    public $costKeys = null;
    public bool $netAmountInput = false;
    public bool $onlyConsumptionEdit = false;

    /* initialization */
    public function mount(Cost $cost, bool $netAmountInput, string $costInvoicingType)
    {
        $this->cost = $cost;
        $this->costTypes = CostType::where('costInvoicingType_id','=', $costInvoicingType)->get()->sortBy('sort');
        $this->fuelTypes = FuelType::all();
        $this->costKeys = $cost->realestate->costsKeys;
        $this->netAmountInput = $netAmountInput;
    }

    protected $listeners = [
        'showCostDetailModal' => 'showModal',
        'closeCostDetailModal' => 'closeModal',
    ];
 
    public function rules()
    {
        return [
            'cost.caption' => 'required|min:2',      
            'cost.costType_id' => 'required',
            'cost.fuelType_id' => 'nullable', 
            'cost.start_value_editing' => 'nullable', 
            'cost.start_value_amount_gros_editing'=> 'nullable',
            'cost.start_value_amount_net_editing'=> 'nullable',
            'cost.end_value_editing' => 'nullable', 
            'cost.haushaltsnah' => 'nullable', 
            'cost.co2Tax'=> 'required',
            'cost.allocationKey_id' => 'nullable', 
            'cost.noticeForUser' => 'nullable', 
            'cost.noticeForNeko' => 'nullable', 
            'cost.consumption' => 'nullable', 
            'cost.prevyearPeriod' => 'nullable',
            'cost.prevyearAmountnet' => 'nullable',
            'cost.prevyearAmountgros' => 'nullable', 
            'cost.nekoId' => 'required', 
            'cost.realestate_id' => 'required', 
        ];
    }

    public function makeBlankObject(Cost $cost)
    {
        return Cost::make([
            'nekoId' => 0,
            'realestate_id' => $cost->realestate->id,
            'costType_id' => $cost->costType->type_id,
            'consumption' => false
        ]);
    }

    public function showModal (Cost $cost, $add, $onlyConsumptionEdit){
        if ($add) {
            $this->cost = $this->makeBlankObject($cost);
        } else {
            $this->cost = $cost;
        }
        $this->onlyConsumptionEdit = $onlyConsumptionEdit;
        $this->showEditModal = true;
    }

    public function closeModal($save){
        if ($save){
            $this->cost->co2Tax = $this->cost->can_co2;
            if ($this->cost->cost_type != null && $this->cost->cost_type == 'BRK') {
                $this->cost->consumption = true;
            }
            $this->validate();
            $this->cost->save();
            $this->showEditModal = false;
            $this->emit('refreshComponents');         
        }else{
            $this->showEditModal = false;
        }       
   }

   

    public function render()
    {
       return view('livewire.user.cost.detail');
    }
}
