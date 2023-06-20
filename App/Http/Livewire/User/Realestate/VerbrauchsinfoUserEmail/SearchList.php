<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;
use App\Http\Livewire\DataTable\WithSorting;

class SearchList extends Component
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
        $result = $this->realestate->occupants->where('nutzeinheitNo','=',$nutzeinheitNo)->sortBy('dateFrom')->first();
        return $result;
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

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
        ;

        return view('livewire.user.realestate.verbrauchsinfo-user-email.search-list', [
            'rows' => $this->rows,
            'nutzeinheiten' => $nutzeinheiten,
        ]);
    }
}

    

