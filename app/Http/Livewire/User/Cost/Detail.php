<?php

namespace App\Http\Livewire\User\Cost;
use App\Models\Cost;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;



class Detail extends Component
{
    use WireToast; 

    public $cost = null;
    public $showEditModal = false;

    protected $listeners = [
        'showCostDetailModal' => 'showModal',
        'closeCostDetailModal' => 'closeModal',
    ];
 
    public function rules()
    {
        return [
            'cost.nazwa' => 'required|min:2',      
            'cost.bemerkung' => 'sometimes',
            'cost.costType' => 'required', 
            'cost.costType_id' => 'required',
            'cost.vatAmount' => 'nullable', 
            'cost.fuelType' => 'nullable', 
            'cost.fuelType_id' => 'nullable', 
            'cost.hasTank' => 'nullable', 
            'cost.startValue' => 'nullable', 
            'cost.endValue' => 'nullable', 
            'cost.startValueAmount' => 'nullable', 
            'cost.haushaltsnah' => 'nullable', 
            'cost.keyId'=> 'required',
            'cost.keyName' => 'nullable', 
            'cost.keyShortkey' => 'nullable', 
            'cost.noticeForUser' => 'nullable', 
            'cost.noticeForNeko' => 'nullable', 
            'cost.costAbrechnungType' => 'nullable', 
            'cost.costAbrechnungTypeId' => 'nullable',
            'cost.fuelTypeUnitType' => 'nullable',
            'cost.fuelTypeUnitName' => 'nullable', 
            'cost.startValueAmountNet' => 'nullable', 
            'cost.startValueAmountGros' => 'nullable', 
            'cost.keyUnitType' => 'nullable'
        ];
    }

    public function showModal (Cost $cost){
        $this->cost = $cost;
        $this->showEditModal = true;
    }

    public function closeModal($save){
        if ($save){
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
