<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Traits\Helpers;
use App\Events\CostUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    use HasFactory;
    use WireToast;
    use Helpers;

    protected $fillable = [
        'realestate_id', 'nekoId', 'caption', 'description', 'costType_id',
        'fuelType_id', 'startValue', 'endValue',
        'startValueAmountNet', 'startValueAmountGros', 'startValueAmountVat', 
        'haushaltsnah', 'co2Tax', 'allocationKey_id', 'consumption',
        'noticeForUser', 'noticeForNeko', 
        'prevyearPeriod', 'prevyearQuantity', 'prevyearAmountnet', 'prevyearAmountgros'
    ];

    public function scopeIsHeizkosten($query)
    {
        $ret_val = $query
        ->where(function($query)
        {
            $query->where('costType_id', 'HNK')
            ->orWhere('costType_id', 'BRK')
            ->orWhere('costType_id', 'KWK')
            ->orWhere('costType_id', 'KWA')
            ->orWhere('costType_id', 'ZKW')
            ->orWhere('costType_id', 'DIR')
            ->orWhere('costType_id', 'BEH')
            ->orWhere('costType_id', 'ZWA')
            ->orWhere('costType_id', 'ZUK');
        });
        return $ret_val;
    }

    public function scopeIsBetriebskosten($query)
    {
        $ret_val = $query
        ->where(function($query)
        {
            $query->where('costType_id', 'BEK')
            ->orWhere('costType_id', 'BEE');
        });
        return $ret_val;
    }


    protected $appends = [
                            'cost_type_sort',
                            'consumptionsum',
                            'coconsumptionsum',
                            'cobruttosum',
                            'conettosum',
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
                            'can_co2',
                            'allocation_key',
                            'haushaltsnah_sum'
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
    public function getHaushaltsnahSumAttribute(){
        return number_format($this->costAmounts->sum('grosAmount_HH'), 2, ',', '.');
    }
    public function getConsumptionsumAttribute(){
        return number_format($this->costAmounts->sum('consumption'), 1, ',', '.');
    }
    public function getCoconsumptionsumAttribute(){
        return number_format($this->costAmounts->sum('co2TaxValue'), 1, ',', '.');
    }
    public function getCobruttosumAttribute(){
        return number_format($this->costAmounts->sum('co2TaxAmount_gros'), 1, ',', '.');
    }
    public function getConettosumAttribute(){
        return number_format($this->costAmounts->sum('co2TaxAmount_net'), 1, ',', '.');
    }


    public function getCostTypeSortAttribute()
    {
        if ($this->costType != null) {
            return $this->costType->sort;
        }
        return 10000;
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

    public function getAllocationKeyAttribute()
    {
        return CostKey::where('id', $this->allocationKey_id)->first();
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

    public function allocationKey()
    {
        return $this->belongsTo(CostKey::class);
    }

    public function costType()
    {
        return $this->belongsTo(CostType::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    // public function castStringToDouble($value){
    //      if($value){     
    //          $tvalue = str_replace('.','@', $value);
    //          $tvalue = str_replace(',','.', $tvalue);
    //          $tvalue = str_replace('@','', $tvalue);
    //          return floatval($tvalue);
    //      }
    //      return null;
    // }


    protected $dispatchesEvents = [
        'updated' => CostUpdated::class,
    ];
}
