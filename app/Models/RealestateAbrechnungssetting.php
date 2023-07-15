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
          ]);

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

  
