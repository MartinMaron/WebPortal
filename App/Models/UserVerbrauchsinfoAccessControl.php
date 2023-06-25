<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVerbrauchsinfoAccessControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupant_id', 'user_id', 'neko_id', 'jahr_monat', 'datum'
    ];
    public function user()
    {
        
        return $this->belongsTo(User::class);
    }

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    public function getDatumAttribute()
    {
        if($this->dateTo){
            return Carbon::parse($this->dateTo)->format('d.m.Y');
        }
        return '';
    }

    public static function validateImportData($data)
    {
        return  Validator::make($data, [
            'neko_lokator_id' => 'required|string|max:40',
            'email' => 'required|email',
            'jahr_monat' => 'required|string|max:7',
            'neko_id' => 'required|integer',
        ]);
    }
}
