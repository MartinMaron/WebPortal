<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CounterMeter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nekoOccupant_id', 'occupant_id', 'occupant_id', 'nekoId', 'nr', 'funkNr', 'art', 'einheit', 'stichtag', 'stichtagStand', 'nutzergrup_id', 'nutzergrup_name', 
        'zeitraum_akt', 'zeitraum_mon', 'zeitraum_vorj', 'verbrauch_akt', 'verbrauch_mon', 'verbrauch_vorj', 
    ];


    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    public static function validateImportData($data) {
        return Validator::make($data, [
            'nekoId' => 'required|string|max:40',
            'nekoOccupant_id' => 'required|string|max:40',
            'nr' => 'required|string|max:255',
            'funkNr' => 'required|string|max:255',
            'art' => 'required|string|max:255',
            'einheit' => 'required|string|max:255',
            'nutzergrup_id' => 'required|numeric',
            'nutzergrup_name' => 'required|string|max:255',
        ]);


    }

}
