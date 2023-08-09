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
    public bool $inputWithoutDatum;

    public CostAmount $current;
    public string $inputStartField;

    public function mount(Cost $cost, $netto, $inputWithoutDatum) {
        $this->cost = $cost;
        $this->vat = $netto;
        $this->inputWithoutDatum = $inputWithoutDatum;
        if ($this->cost->consumption) {
            $this->inputStartField = 'consumption';
        }else{
            if ($this->inputWithoutDatum) {
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
            'description' => '',
            'netAmount' => 0,
            'grosAmount' => 0,
            'grosAmount_HH'=> 0,
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
            'current.netAmount' => 'nullable',
            'current.grosAmount_HH' => 'nullable',
            'current.consumption' => 'required_if:cost.consumption,==,1|numeric|nullable',
            'current.consumption_editing' => 'nullable',
            'current.brutto' => 'nullable',
            'current.netto' => 'nullable',
            'current.haushaltsnah' => 'nullable',
            'current.description' => 'nullable',
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
