<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostInvoicingType extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';
    protected $keyType = 'string';
}
