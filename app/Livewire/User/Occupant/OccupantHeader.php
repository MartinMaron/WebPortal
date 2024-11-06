<?php

namespace App\Http\Livewire\User\Occupant;

use App\Models\Occupant;
use Livewire\Component;

class OccupantHeader extends Component
{
    public $occupant;
    public $showStandardIcon = true;
    public $addAction = null;
    public $hasRealestateOccupantsDifferentAdresses = false;

    public function mount(Occupant $occupant, $addAction = null)
    {
        $this->occupant = $occupant;
        $this->hasRealestateOccupantsDifferentAdresses = $this->occupant->realestate->has_occupants_different_adresses;

        if ($addAction != null) {
            $this->addAction = $addAction; // Store the action if provided
            $this->showStandardIcon = false; // Modify icon visibility based on action
        }
    }

    // Event triggering method (assuming you're dispatching an event)
    public function raise_CreateVerbrauchsinfoUserEmailModal()
    {
        if ($this->addAction) {
            $this->emit($this->addAction, $this->occupant->nutzeinheitNo); // Use emit() instead of dispatch() for Livewire event
        }
    }

    public function render()
    {
        return view('livewire.user.occupant.occupant-header'); // Correct path for the Blade view
    }
}
