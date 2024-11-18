<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostType extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'caption', 'type_id', 'costInvoicingType_id'
    ];
}
