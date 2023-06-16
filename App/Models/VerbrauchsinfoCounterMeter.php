<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerbrauchsinfoCounterMeter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nekoOccupant_id', 'occupant_id', 'occupant_id', 'nekoId', 'nr', 'funkNr', 'art', 'einheit', 'einheit_id', 'nutzergrup_id', 'nutzergrup_name', 
        'hk','ww','jahr_monat','zeitraum_akt', 'zeitraum_mon', 'zeitraum_vorj', 'verbrauch_akt', 'verbrauch_mon', 'verbrauch_vorj', 'stand_anfang','stand_ende', 'faktor'
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
            'einheit_id' => 'required|numeric',
            'nutzergrup_id' => 'required|numeric',
            'nutzergrup_name' => 'required|string|max:255',
        ]);


    }

    public function einh()
    {
        return $this->belongsTo(Einheit::class);
    }
   
    public function getStandDisplayAttribute(){
        return number_format($this->stand_ende, 2, ',', '.');
    }

    public function getVerbrauchAktDisplayAttribute(){
        return number_format($this->verbrauch_akt, 2, ',', '.');
    }

  


}
