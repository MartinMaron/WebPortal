<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVerbrauchsinfoAccessControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupant_id', 'user_id', 'neko_id', 'jahr_monat'
    ];

    public function user()
    {
        
        return $this->belongsTo(User::class);
    }

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    public static function validateImportData($data)
    {
        return  Validator::make($data, [
            'occupant_id' => 'required|string|max:40',
            'user_id' => 'required|string|max:40',
            'jahr_monat' => 'required|string|max:7',
            'neko_id' => 'required|integer',
        ]);
    }
}
