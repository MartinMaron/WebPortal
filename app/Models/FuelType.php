<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';
    protected $keyType = 'string';

    protected $fillable = [
        'hasTank', 'caption'
     ];
 
    public function Einheit()
    {
        return $this->belongsTo(Einheit::class);
    }
}
