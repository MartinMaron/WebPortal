<?php

namespace App\Http\Livewire\User\Realestate;

use Livewire\Component;
use App\Models\Realestate;

class HeaderAddress extends Component
{

    public Realestate $realestate;
    public $editablePeriod = false;

    public function mount($baseobject)
    {
        $this->realestate = $baseobject;
    }

    public function rules()
    {
        return [
            'realestate.abrechnungssetting_id' => 'required',      
        ];
    }

    public function updated($propertyName)
    {
        $this->realestate->save();
        return redirect(request()->header('Referer'));
    }



    public function render()
    {
        return view('livewire.user.realestate.header-address');
    }
}
