<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use App\Http\Traits\Helpers;
use App\Events\CostAmountAdded;
use App\Events\CostAmountDeleted;
use App\Events\CostAmountUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;

class CostAmount extends Model
{
    use Helpers;
    use WireToast;

    protected $fillable = [
        'nekoId', 'cost_id', 'bemerkung', 'nekoWebId', 'tryWebDelete', 'description', 'netAmount', 'grosAmount',
        'dateCostAmount', 'consumption', 'grosAmount_HH', 'netto', 'brutto', 'datum'
    ];

    protected $casts = [
        'datum' => 'date:d.m.Y',
        'grosAmount' => 'decimal:2',
        'consumption' => 'decimal:3',
        'consumption_editing' => 'decimal:3',
        'brutto' => 'decimal:2',
        'netto' => 'decimal:2',
        'grosAmount_HH' => 'decimal:2',
        'netAmount' => 'decimal:2' ];

    protected $appends = [
        'consumption_editing',
        'brutto',
        'netto',
        'datum',
        'haushaltsnah',
    ];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }

    public static function validateImportData($data) {
        return Validator::make($data, [
            'nekoCostId'=> 'nullable',
            'bemerkung'=> 'nullable|string|max:500',
            'tryWebDelete'=> 'required|boolean',
            'description'=> 'nullable|string|max:500',
            'netAmount'=> 'required|numeric',
            'grosAmount'=> 'required|numeric',
            'datum'=> 'nullable|date',
            'dateCostAmount'=> 'nullable|date',
            'consumption'=> 'nullable|numeric',
            'grosAmount_HH'=> 'nullable|numeric',
            'nekoCostAmountId' => 'nullable|numeric',
        ]);
    }

    protected $dispatchesEvents = [
        'created' => CostAmountAdded::class,
        'updated' => CostAmountUpdated::class,
        'deleted' => CostAmountDeleted::class,
    ];

}
