<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Einheit extends Model
{

//    protected $table = 'einheiten';

    protected $fillable = [
       'id', 'caption', 'shortname',
    ];

}
