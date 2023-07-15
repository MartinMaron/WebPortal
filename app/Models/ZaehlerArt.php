<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZaehlerArt extends Model
{
    use HasFactory;
    protected $table = 'zaehler_arten';


    protected $fillable = [
        'caption', 'einheit_id', 'sort_reihenfolge'
    ];

}
