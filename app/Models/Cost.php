<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
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
        'realestate_id', 'nekoId', 'caption', 'description', 'costType_id',
        'fuelType_id', 'startValue', 'endValue',
        'startValueAmountNet', 'startValueAmountGros', 'startValueAmountVat', 
        'haushaltsnah', 'co2Tax', 'allocationKey_id', 'consumption',
        'noticeForUser', 'noticeForNeko', 
        'prevyearPeriod', 'prevyearQuantity', 'prevyearAmountnet', 'prevyearAmountgros'
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
            ->orWhere('costType_id', 'BEK')
            ->orWhere('costType_id', 'ZUK');
        });
        return $ret_val;
    }

    protected $appends = [
                            'cost_type_sort',
                            'consumptionsum',
                            'brutto',
                            'netto',
                            'gros',
                            'cost_type',
                            'fuel_type',
                            'start_value_editing',
                            'end_value_editing',
                            'start_value_amount_gros_editing',
                            'start_value_amount_net_editing',
                            'prevyear_quantity_view', 
                            'prevyear_amountnet_view',
                            'prevyear_amountgros_view',
                            'need_allocation_key',
                            'can_co2'
                        ];

    protected $casts = ['consumptionsum' => 'decimal:1',
                        'netto' => 'decimal:2',
                        'brutto' => 'decimal:2',
                        'start_value_editing' => 'decimal:1',
                        'end_value_editing' => 'decimal:1',
                        'startValueAmountGros' => 'decimal:2',
                        'startValueAmountNet' => 'decimal:2' ];

    
    
    
    public function getNeedAllocationKeyAttribute(){
        return $this->costType != null &&
                !($this->costType->type_id == 'BRK' ||
                $this->costType->type_id == 'HNK' ||
                $this->costType->type_id == 'ZUK' ||
                $this->costType->type_id == 'ZKW');
    }

    public function getCanCo2Attribute(){
        return $this->fuelType != null &&
                ($this->fuelType->type_id == 'EC4' ||
                $this->fuelType->type_id == 'GS4' ||
                $this->fuelType->type_id == 'OL9');
    }


    public function getPrevyearQuantityViewAttribute(){
        return number_format($this->prevyearQuantity, 2, ',', '.');
    }
    public function getPrevyearAmountnetViewAttribute(){
        return number_format($this->prevyearAmountnet, 2, ',', '.');
    }
    public function getPrevyearAmountgrosViewAttribute(){
        return number_format($this->prevyearAmountgros, 2, ',', '.');
    }

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
    public function getGrosAttribute(){
        return $this->costAmounts->sum('grosAmount');
    }

    public function setStartValueEditingAttribute($value){
        $this->startValue = $this->castStringToDouble($value);
    }

    public function getStartValueEditingAttribute(){
        if ($this->startValue <> 0){
            return number_format($this->startValue, 1, ',', '.');
        }else{
            return '';
        } 
    }

    public function setStartValueAmountNetEditingAttribute($value){
        $this->startValueAmountNet = $this->castStringToDouble($value);
    }

    public function getStartValueAmountNetEditingAttribute(){
        if ($this->startValueAmountNet <> 0){
            return number_format($this->startValueAmountNet, 1, ',', '.');
        }else{
            return '';
        } 
    }

    public function setStartValueAmountGrosEditingAttribute($value){
        $this->startValueAmountGros = $this->castStringToDouble($value);
    }

    public function getStartValueAmountGrosEditingAttribute(){
        if ($this->startValueAmountGros <> 0){
            Debugbar::info("startBetrag: ". $this->startValueAmountGros);
            return number_format($this->startValueAmountGros, 2, ',', '.');
        }else{
            return '';
        } 
    }

    public function setEndValueEditingAttribute($value){
        $this->endValue = $this->castStringToDouble($value);
    }

    public function getEndValueEditingAttribute(){
        if ($this->endValue <> 0){
            return number_format($this->endValue, 1, ',', '.');
        }else{
            return '';
        } 
    }

    public function getCostTypeAttribute()
    {
        return CostType::where('type_id', $this->costType_id)->first();
    }

    public function getFuelTypeAttribute()
    {
        return FuelType::where('type_id', $this->fuelType_id)->first();
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

    public function costType()
    {
        return $this->belongsTo(CostType::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function castStringToDouble($value){
         if($value){     
             $tvalue = str_replace('.','@', $value);
             $tvalue = str_replace(',','.', $tvalue);
             $tvalue = str_replace('@','', $tvalue);
             return floatval($tvalue);
         }
         return null;
    }


    protected $dispatchesEvents = [
        'updated' => CostUpdated::class,
    ];
}
