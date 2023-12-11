<?php

namespace App\Models;

use App\Events\CostUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostKey extends Model
{
    use HasFactory;
    use WireToast; 
    
    protected $fillable = [
       'nekoKey_id', 'realestate_id', 'bemerkung', 'description', 'zeitanteil', 'einheit','shortKey', 'viewText'
    ];

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }
}
