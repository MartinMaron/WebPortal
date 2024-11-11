<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealestateAbrechnungssetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'neko_id','realestate_id', 'bemerkung', 'tryWebDelete', 'description', 'nabi_inhaber', 'nabi_nr',
        'stromkosten','brenwert_gasabrechnug','eigen_energielieferung','aktiv',
        'co2_kennzeichen_WEG', 'co2_wohngeb','co2_kennzeichen_1_9', 'co2_kennzeichen_2_9', 'co2_anschluss_nach_2022'
    ];

    protected $appends = ['gebart',
                         ];

    public static function validateImportData($data)
    {
        return  Validator::make($data, [
            'neko_id' => 'required|integer',
            'bemerkung' => 'nullable|string|email|max:255',
            'tryWebDelete' => 'required|boolean',
            'description' => 'nullable|string|max:255',
            'nabi_inhaber' => 'nullable|string|max:255',
            'nabi_nr' => 'nullable|string|max:50',
            'stromkosten' => 'required|numeric',
            'brenwert_gasabrechnug' => 'required|boolean',
            'eigen_energielieferung' => 'required|boolean',
            'aktiv' => 'required|boolean',
            'co2_kennzeichen_WEG' => 'required|boolean', 
            'co2_wohngeb' => 'required|boolean',
            'co2_kennzeichen_1_9' => 'required|boolean', 
            'co2_kennzeichen_2_9' => 'required|boolean', 
            'co2_anschluss_nach_2022' => 'required|boolean'
          ]);

    }

    protected function getGebartAttribute()
    {
        if($this->co2_wohngeb){
            return "Wohngebäude";
        }else{
            return "Nichtwohngeb.";
        }
        return '';
    }

    public function scopeAktiv($query)
    {
        $query->where('aktiv', 1)
               ->Where('tryWebDelete', 0);
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }

}

  
