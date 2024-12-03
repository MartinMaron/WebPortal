<?php

namespace app\Http\Livewire\User\Occupant;

use Livewire\Component;
use App\Models\Occupant;
use Barryvdh\Debugbar\Facades\Debugbar;

class VorauszahlungEdit extends Component
{

    public Occupant $occupant;
    public $vorauszahlung;


    public function mount(Occupant $occupant){
        $this->occupant = $occupant;
        $this->vorauszahlung = $occupant->vorauszahlung_editing;
      }

    public function confirmPrePaid()
    {
        $this->occupant->vorauszahlung_editing = floatval($this->vorauszahlung);
        $this->occupant->save();
    }

    public function rules() { return [
         'occupant.vorauszahlung_editing' => 'nullable',
         'vorauszahlung' => 'nullable',
    ]; }
    public function render()
    {
        return view('livewire.user.occupant.vorauszahlung-edit');
    }
}
