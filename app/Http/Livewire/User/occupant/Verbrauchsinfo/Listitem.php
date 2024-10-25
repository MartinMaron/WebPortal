<?php

namespace App\Http\Livewire\User\Occupant\Verbrauchsinfo;
use AllowDynamicProperties;
use App\Models\Verbrauchsinfo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

#[AllowDynamicProperties] class Listitem extends Component
{

    public $singleVerbrauchsinfo;


    /**
     * @param Verbrauchsinfo $singleVerbrauchsinfo
     * @return void
     */
    public function mount(Verbrauchsinfo $singleVerbrauchsinfo): void
    {
        $this->verbrauchsinfo = $singleVerbrauchsinfo;
    }

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.user.occupant.verbrauchsinfo.listitem');
    }
}
