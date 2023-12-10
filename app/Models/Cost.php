<?php

namespace App\Models;

use App\Events\CostUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    use HasFactory;
    use WireToast; 
    
    protected $fillable = [

        'realestate_id', 'nekoId', 'unvid','budguid', 'nazwa', 'bemerkung', 'NekoWebId', 'tryWebDelete', 'costType', 'costType_id',
        'vatAmount', 'fuelType', 'fuelType_id', 'hasTank', 'startValue', 'endValue', 'startValueAmount', 'haushaltsnah', 'keyId',
        'keyName', 'keyShortkey', 'noticeForUser', 'noticeForNeko', 'costAbrechnungType', 'costAbrechnungTypeId','fuelTypeUnitType',
        'fuelTypeUnitName', 'startValueAmountNet', 'startValueAmountGros', 'keyUnitType', 'consumption'
    ];

    public function scopeVisible($query)
    {
       
        
        $ret_val = $query
        ->where(function($query) 
        {
            $query->where('costType_id', 'HNK')
            ->orWhere('costType_id', 'BRK')
            ->orWhere('costType_id', 'KWK')
            ->orWhere('costType_id', 'KWA')
            ->orWhere('costType_id', 'ZKW')
            ->orWhere('costType_id', 'ZUK');
        });
        return $ret_val;      
    }
    
    protected $appends = [
                            'cost_type_sort',
                            'consumptionsum',
                            'brutto',
                            'netto'
                        ];

    protected $casts = ['consumptionsum' => 'decimal:1',
                        'netto' => 'decimal:2',
                        'brutto' => 'decimal:2',
                        'startValueAmountGros' => 'decimal:2',
                        'startValueAmountNet' => 'decimal:2' ];

    public function getNettoAttribute(){
        return number_format($this->costAmounts->sum('netAmount'), 2, ',', '.');
    }
    public function getBruttoAttribute(){
        return number_format($this->costAmounts->sum('grosAmount'), 2, ',', '.');
    }
    public function getConsumptionsumAttribute(){
        return number_format($this->costAmounts->sum('consumption'), 1, ',', '.');
    }
    
    public function getCostTypeSortAttribute()
    {
        $ret_val = 0;

        switch ($this->costType_id) {
            case 'BRK':
                $ret_val = 1;
                break;
            case 'HNK':
                $ret_val = 2;
                break;
            case 'ZUK':
                $ret_val = 3;
                break;
            case 'ZKW':
                $ret_val = 4;
                break;
            case 'KWK':
                $ret_val = 5;
                break;
            case 'KWA':
                $ret_val = 6;
                break;
            case 'BEK':
                $ret_val = 7;
                    break;
        }

        return $ret_val ;
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }

    public function costAmounts()
    {
        return $this->hasMany(CostAmount::class);
    }

    public function costKeys()
    {
        return $this->hasMany(CostKey::class);
    }
 
    public static function validateImportData($data) {
        return Validator::make($data, [
            'nekoId' => 'required|integer',
            'unvid' => 'required|string|max:40',
            'budguid' => 'required|string|max:40',
            'nazwa' => 'required|string|max:255',
            'tryWebDelete' => 'required|boolean',
            'costType' => 'required|string|max:255',
            'costType_id' => 'required|string|max:3',
            'vatAmount' => 'required|numeric',
            'hasTank' => 'required|boolean',
            'haushaltsnah' => 'required|boolean',
            'keyId' => 'required|numeric',
            'keyName' => 'required|string|max:255',
            'keyShortkey' => 'required|string|max:255',
            'noticeForUser' => 'nullable|string|max:255',
            'noticeForNeko' => 'nullable|string|max:255',
            'fuelTypeUnitType' => 'nullable',
            'fuelTypeUnitName'=> 'nullable',
            'startValueAmountNet'=> 'nullable',
            'startValueAmountGros'=> 'nullable',
            'costAbrechnungType' => 'required|string|max:255',
            'costAbrechnungTypeId' => 'required|string|max:255',
            'keyUnitType' => 'required|string|max:255',
            'consumption' => 'required|boolean',                                    
        ]);
    }



    protected $dispatchesEvents = [
        'updated' => CostUpdated::class,
    ];
}
