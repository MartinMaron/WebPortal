<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Realestate;
use App\Models\VerbrauchsinfoUserEmail;
use App\Http\Livewire\DataTable\WithSorting;
use Usernotnull\Toast\Concerns\WireToast;

class SearchList extends Component
{
    use WithSorting, WireToast; 


    public Realestate $realestate;
    public VerbrauchsinfoUserEmail $currentUserEmail;
        
    public function mount($realestate, $page)
    {
        $this->realestate = $realestate;
    }
    
    protected $listeners = [
        'refreshParent' => '$refresh', 
        'deleteConfirmed' => 'delete',
    ];

    public function delete($objectId, $objectType)
    {
        if ($objectType != 'VerbrauchsinfoUserEmail') return;
        $object = VerbrauchsinfoUserEmail::find($objectId);
        $object->delete();
        toast()->success('Emailadresse für Verbraucherinformationen gelöscht','Achtung')->push();      
    }

    public function getUserEmailsForNutzeinheitNo($nutzeinheitNo){
        return $this->rows->where('nutzeinheitNo','=',$nutzeinheitNo);
    }


    
    public function lastOccupant($nutzeinheitNo){
        $result = $this->realestate->occupants->where('nutzeinheitNo','=',$nutzeinheitNo)->sortBy('dateFrom')->first();
        return $result;
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
        ;

        return view('livewire.user.realestate.verbrauchsinfo-user-email.search-list', [
            'rows' => $this->rows,
            'nutzeinheiten' => $nutzeinheiten,
        ]);
    }
}

    

