<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use App\Http\Traits\Helpers;
use App\Events\CostAmountAdded;
use App\Events\CostAmountDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostAmount extends Model
{
    use HasFactory;
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

    public function setConsumptionEditingAttribute($value){
        $this->consumption = $this->castStringToDouble($value);
    }

    public function getConsumptionEditingAttribute(){
        if($this->consumption){
            return number_format($this->consumption, 3, ',', '.');            
        }
        return null;
    }
    public function setBruttoAttribute($value){
        $this->grosAmount = $this->castStringToDouble($value);
    }

    public function getBruttoAttribute(){
        return number_format($this->grosAmount, 2, ',', '.');
    }

    public function setNettoAttribute($value){
        $this->netAmount = $this->castStringToDouble($value);
    }

    public function getNettoAttribute(){
        return number_format($this->netAmount, 2, ',', '.');
    }

    public function setHaushaltsnahAttribute($value){
        $this->grosAmount_HH = $this->castStringToDouble($value);
    }

    public function getHaushaltsnahAttribute(){
        return number_format($this->grosAmount_HH, 2, ',', '.');
    }

    public function getDatumAttribute()
    {
        if($this->dateCostAmount){
            return Carbon::parse($this->dateCostAmount)->format('d.m.Y');
        }
    }
    public function setDatumAttribute($value)
    {
        try {
            $value = str_replace('.','',$value);
            $dt = Carbon::createFromFormat('dmY', $value);
            $this->dateCostAmount = Carbon::parse($dt);
        } catch (Exception $e) {
        }
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
        'deleted' => CostAmountDeleted::class,
    ];

}
