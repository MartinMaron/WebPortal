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
       'nekoKey_id', 'nekoCostKey_id', 'realestate_id', 'bemerkung', 'tryWebDelete','description', 'zeitanteil', 'einheit','shortKey', 'viewText'
    ];

    public function scopeVisible($query)
    {
        $query->where('tryWebDelete', false);
    }

  
    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }
 
    public static function validateImportData($data) {
        return Validator::make($data, [
            'nekoCostKey_id'=> 'required|integer',
            'nekoKey_id'=> 'required|integer',
            'bemerkung'=> 'nullable|string|max:300',
            'tryWebDelete'=> 'required|boolean',
            'description'=> 'nullable|string|max:300',
            'zeitanteil'=> 'required|boolean',
            'einheit'=> 'required|string|max:100',
            'shortKey'=> 'required|string|max:2',
            'viewText'=> 'required|string|max:155',                                     
        ]);
    }

}
