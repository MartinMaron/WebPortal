<?php

namespace App\Http\Livewire\User\Costamount;

use Livewire\Component;
use App\Models\CostAmount;
use Usernotnull\Toast\Concerns\WireToast;

class Detail extends Component
{
  
    public CostAmount $costAmount;
    public $showCostAmountEditModal;
    public bool $showDatumField = true;
    public bool $readonlyDatumField = false;
    public bool $showConsumptionField = true;
    public bool $readonlyConsumptionField = true;
    public bool $showNetto = true;
    public bool $readonlyBetragField = false;
    public bool $showHaushaltsnahField = true;
    public bool $readonlyHaushaltsnahField = true;
  
    
    // public function mount($costAmount) {
    //     if($costAmount){
    //         $this->costAmount = $costAmount;
    //         $this->showDatumField =  ($this->costAmount->cost->realestate->eingabeCostOhneDatum != true) && ($this->costAmount->datum != "01.01.0001");
    //         $this->readonlyDatumField = $this->costAmount->nekoId > 0;
    //     }else{
    //         $this->costAmount = $this->makeBlankObject();           
    //     }
    // }
    
    public function makeBlankObject()
    {
        return CostAmount::make([
            'bemerkung' =>'', 
            'description' => '',
            'netAmount' => 0, 
            'grosAmount' => 0,
            'grosAmount_HH'=> 0,  
        ]);
    }     
  
    protected $listeners = [
        'saveCostAmountDetail' => 'save',
        'showCostAmountDetailModal' => 'showCostAmountDetailModal',
        'closeCostAmountDetailModal' => 'closeCostAmountDetailModal',
    ];

  
    public function rules()
    {
        return [
            'costAmount.bemerkung' => 'nullable',      
            'costAmount.description' => 'nullable',
            'costAmount.netAmount' => 'nullable', 
            'costAmount.grosAmount' => 'nullable',
            'costAmount.dateCostAmount' => 'nullable', 
            'costAmount.datum' => 'nullable|date', 
            'costAmount.consumption_editing' => 'nullable', 
            'costAmount.netto' => 'nullable', 
            'costAmount.haushaltsnah' => 'nullable', 
            'costAmount.brutto' => 'nullable', 
            'costAmount.grosAmount_HH' => 'nullable'           
        ];
    }
   
   
    public function showCostAmountDetailModal (CostAmount $costAmount){
        $this->costAmount = $costAmount;
        $this->showCostAmountEditModal = true;
        $this->showConsumptionField = $costAmount->cost->consumption;
        $this->showNetto = $costAmount->cost->realestate->eingabeCostNetto;
        $this->showHaushaltsnahField = $costAmount->cost->haushaltsnah;
    
    }

    public function closeCostAmountDetailModal($save){
        if ($save && $this->costAmount){  
            if ($this->validate())
            {
                $this->costAmount->save();
                $this->showCostAmountEditModal = false ;
                $this->emit('refreshComponents');    
            }else{
                $this->showCostAmountEditModal = false;              
            };
        }else{
            $this->showCostAmountEditModal = false;
        }             
   }
   

    
    public function render()
    {
        return view('livewire.user.costamount.detail');
    }
}
