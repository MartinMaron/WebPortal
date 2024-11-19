<?php

namespace App\Http\Livewire\User\Cost;
use App\Models\Cost;
use Livewire\Component;
use App\Models\CostType;
use App\Models\FuelType;
use Usernotnull\Toast\Concerns\WireToast;



class Detail extends Component
{
    use WireToast; 
    public $cost = null;
    public $showEditModal = false;
    public $costTypes = null;
    public $fuelTypes = null;
    public $costKeys = null;
    public bool $netAmountInput = false;
   
    /* initialization */
    public function mount(Cost $cost, bool $netAmountInput)
    {
        $this->cost = $cost;
        $this->costTypes = CostType::all();
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
        ];
    }

    public function showModal (Cost $cost){
        $this->cost = $cost;
        $this->showEditModal = true;
    }

    public function closeModal($save){
        if ($save){
            $this->validate();
            $this->cost->co2Tax = $this->cost->can_co2;
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
