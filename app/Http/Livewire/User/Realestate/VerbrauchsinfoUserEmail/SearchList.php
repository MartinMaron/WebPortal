<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Realestate;
use App\Models\VerbrauchsinfoUserEmail;
use App\Http\Livewire\DataTable\WithSorting;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Builder;


class SearchList extends Component
{
    use WithSorting, WireToast;
    public Realestate $realestate;
    public VerbrauchsinfoUserEmail $currentUserEmail;
    public $filter;


    public function mount($realestate)
    {
        $this->realestate = $realestate;
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteConfirmed' => 'delete',
        'createUserEmailModal' => 'createUserEmailModal'
    ];

    public function delete($objectId, $objectType)
    {
        if ($objectType != 'VerbrauchsinfoUserEmail') return;
        $object = (new \App\Models\VerbrauchsinfoUserEmail)->find($objectId);
        $object->delete();
        toast()->success('Emailadresse für Verbraucherinformationen gelöscht','Achtung')->push();
    }

    public function getUserEmailsForNutzeinheitNo($nutzeinheitNo){
        return $this->rows->where('nutzeinheitNo','=',$nutzeinheitNo);
    }


    public function rules()
    {
        return [
            'userEmail.aktiv' => 'nullable',
            'userEmail.email' => 'required|string|email|max:255',
            'userEmail.dateFrom' => 'nullable|date',
            'userEmail.dateTo' => 'nullable|date',
            'userEmail.firstinitUsername' => 'nullable',
            'userEmail.nutzeinheitNo' => 'required',
            'userEmail.realestate_id' => 'required',
            'userEmail.webupdate' => 'nullable',
        ];
    }

    public function makeBlankObject()
    {
        return VerbrauchsinfoUserEmail::make([
            'realestate_id' => $this->realestate->id,
            'dateFrom' => Carbon::now(),
            'webupdate' => 1,
            'email' => 'info@e-neko.de',
        ]);
    }

    public function createUserEmailModal($NutzeinheitNo){
        $this->currentUserEmail = $this->makeBlankObject();
        $this->currentUserEmail->nutzeinheitNo = $NutzeinheitNo;
        $this->emit('showCreateUserEmailModal', $this->currentUserEmail);
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

        return view('livewire.user.realestate.verbrauchsinfo-user-email.search-list', [
            'rows' => $this->rows,
            'nutzeinheiten' => $nutzeinheiten,
        ]);
    }
}



