<?php

namespace App\Livewire\User\Realestate;

use Livewire\Component;
use App\Models\Realestate;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class SearchList extends Component
{
    use WithPagination;

    public $filter = [
        'search' => null,
    ];

    public function updatingfilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $filtered = (new \App\Models\Realestate)->select([
            'id',
            'address',
            'street',
            'postCode',
            'heizkosten',
            'city',
            'rauchmelder',
            'miete',
         ])->orderBy('street')
         ->where('user_id', auth()->user()->id)
         ->where('address','LIKE','%'. $this->filter['search'].'%')
         ->where(function (Builder $query) {$query->Visible();})
         ->paginate(20);

        return view('livewire.user.realestate.search-list',compact('filtered'));
    }
}
