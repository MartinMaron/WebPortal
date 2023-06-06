<?php

namespace App\Http\Livewire\User\Realestate\Abrechnung;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Realestate;
use App\Models\RealestateAbrechnungssetting;

class Einstellungen extends Component
{
    public Realestate $realestate;
    public RealestateAbrechnungssetting $einstellungen;

    public function mount($baseobject)
    {
        $this->realestate = $baseobject;
        $this->einstellungen = RealestateAbrechnungssetting::query()
        ->where('realestate_id', '=', $this->realestate->id)
        ->where(function (Builder $query) {$query->Aktiv();})
        ->first();
     }
    
     public function rules()
     {
         return [
             'realestate.eingabeCostNetto' => 'nullable',      
             'realestate.eingabeCostOhneDatum' => 'nullable',      
             'einstellungen.stromkosten' => 'numeric',      
             'einstellungen.nabi_inhaber' => 'nullable',
             'einstellungen.nabi_nr' => 'nullable'
         ];
     }

    public function render()
    {
        return view('livewire.user.realestate.abrechnung.einstellungen');
    }
}
