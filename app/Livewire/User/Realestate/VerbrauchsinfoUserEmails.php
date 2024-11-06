<?php

namespace App\Livewire\User\Realestate;

use Livewire\Component;
use App\Models\Realestate;
use App\Livewire\DataTable\WithSorting;

class VerbrauchsinfoUserEmails extends Component
{
    use WithSorting;

    public Realestate $realestate;

    public function mount($realestate)
    {
        $this->realestate = $realestate;
    }

    public function getUserEmailsForNutzeinheitNo($nutzeinheitNo){
        return $this->rows->where('nutzeinheitNo','=',$nutzeinheitNo);
    }

    public function lastOccupant($nutzeinheitNo){
        return $this->realestate->occupants->where('nutzeinheitNo','=',$nutzeinheitNo)->sortBy('dateFrom')->first();
    }


    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function getRowsQueryProperty()
    {
        $result = $this->realestate->verbrauchsinfoUserEmails();

        return $this->applySorting($result);
    }


    public function render()
    {
        $nutzeinheiten = $this->rowsQuery
        ->get()->unique('nutzeinheitNo');

        return view('livewire.user.realestate.verbrauchsinfo-user-emails', [
            'rows' => $this->rows,
            'nutzeinheiten' => $nutzeinheiten,
        ]);
    }
}
