<?php

namespace App\Http\Livewire\User\Occupant;

use Livewire\Component;
use App\Models\Occupant;
use Barryvdh\Debugbar\Facades\Debugbar;

class VorauszahlungEdit extends Component
{

    public Occupant $occupant;
    public $vorauszahlung;


    public function mount(Occupant $occupant){
        $this->occupant = $occupant;
        $this->vorauszahlung = $occupant->vorauszahlung;
      }

    public function confirmPrePaid()
    {
        $this->occupant->vorauszahlung= floatval($this->vorauszahlung);
        $this->occupant->save();
    }

    public function rules() { return [
         'occupant.vorauszahlung' => 'nullable',
    ]; }
    public function render()
    {
        return view('livewire.user.occupant.vorauszahlung-edit');
    }
}
