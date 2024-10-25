<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Usernotnull\Toast\Concerns\WireToast;

class CostKey extends Model
{
    use WireToast;

    protected $fillable = [
       'nekoKey_id', 'realestate_id', 'bemerkung', 'description', 'zeitanteil', 'einheit','shortKey', 'viewText'
    ];

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }
}
