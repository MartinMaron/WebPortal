<?php

namespace App\Http\Livewire\User\Costamount;

use App\Models\Cost;
use Livewire\Component;
use App\Models\CostAmount;
use PhpParser\Node\Expr\Cast\Double;
use Barryvdh\Debugbar\Facades\Debugbar;
use Usernotnull\Toast\Concerns\WireToast;

class DetailInput extends Component
{
    use WireToast;

    public Cost $cost;
    public $datum;
    public Double $comsumption;
    public Double $amount;
    public Double $amountHh;
    public $netto;
    public bool $inputWithDate;
    public bool $inputNet;

    public CostAmount $current;
    public string $inputStartField;

    public function mount(Cost $cost, $netto, $inputWithDatum) {
        $this->cost = $cost;
        $this->inputNet = $netto;
        $this->inputWithDate = $inputWithDatum;
        if ($this->cost->consumption) {
            $this->inputStartField = 'consumption';
        }else{
            if ($this->inputWithDate) {
                $this->inputStartField = 'betrag';
            }else {
                $this->inputStartField = 'datum';
            }
        }
        $this->current = $this->makeBlankObject();
    }



    protected $listeners = [
         'refreshDetailInput' => 'refreshByid',
    ];

    public function makeBlankObject()
    {
       return CostAmount::make([
            'nekoCostId' => $this->cost->nekoId,
            'cost_id' => $this->cost->id,
            'bemerkung' =>'',
            'co2TaxAmount_net' => 0,
            'co2TaxAmount_gros' => 0,
            'description' => '',
            'co2TaxValue' => 0, 
            'consumption' => 0,
            'netAmount' => 0, 
            'grosAmount' => 0,
        ]);
    }


    public function refreshByid($id){
        if ($id == $this->cost->id){
            $this->emit('$refresh');
        }
    }


    public function rules()
    {
        return [
            'current.cost_id' => 'required',
            'current.datum' => 'date|nullable',
            'current.netAmount' => 'numeric|nullable',
            'current.grosAmount_HH' => 'nullable',
            'current.grosAmount' => 'numeric|nullable',
            'current.consumption' => 'required_if:cost.consumption,==,1|numeric|nullable',
            'current.consumption_editing' => 'nullable',
            'current.brutto' => 'nullable',
            'current.co2TaxValue' => 'nullable',
            'current.netto' => 'nullable',
            'current.haushaltsnah' => 'nullable',
            'current.description' => 'nullable',
            'current.co2TaxAmount_net' => 'nullable',
            'current.co2TaxAmount_gros' => 'nullable',
            'current.Co2brutto' => 'nullable',
            'current.Co2netto' => 'nullable',
            'current.Co2consupmtion' => 'nullable',
       ];
    }


    public function save()
    {
       
        if ($this->validate()){
            if(CostAmount::create(collect($this->current)->toArray()))  {
                $this->current = $this->makeBlankObject();
                $this->emit('refreshComponents');
            }
        };
    }

    public function render()
    {
        return view('livewire.user.costamount.detail-input');
    }
}
