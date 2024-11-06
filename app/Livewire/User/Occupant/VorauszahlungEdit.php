<?php

namespace App\Http\Livewire\User\Occupant;

use Livewire\Component;
use App\Models\Occupant;

class VorauszahlungEdit extends Component
{
    public Occupant $occupant; // Ensure proper type hint
    public $vorauszahlung;

    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
        $this->vorauszahlung = $occupant->vorauszahlung;
    }

    public function confirmPrePaid()
    {
        // Ensure vorauszahlung is a float value before saving
        $this->occupant->vorauszahlung = floatval($this->vorauszahlung);
        $this->occupant->save();
    }

    public function rules()
    {
        return [
            // Validate vorauszahlung as a numeric value (nullable)
            'vorauszahlung' => 'nullable|numeric',
        ];
    }

    public function render()
    {
        // Return the correct path to the Blade view
        return view('livewire.user.occupant.vorauszahlung-edit');
    }
}
