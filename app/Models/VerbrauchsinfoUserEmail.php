<?php

namespace App\Models;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\MagicConst\Dir;
use App\Events\VerbrauchsinfoUserEmailAdded;
use App\Events\VerbrauchsinfoUserEmailDeleted;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerbrauchsinfoUserEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'realestate_id', 'dateFrom', 'dateTo', 'nutzeinheitNo',
        'neko_id', 'email', 'webupdate','firstinitUsername', 'seit',
        'bis'
    ];

    public static function validateImportData($data) {
        return Validator::make($data, [
            'neko_id' => 'required|numeric',
            'dateFrom' => 'required|date',
            'dateTo' => 'nullable|date',
            'msk_nr' => 'required|numeric',
            'email' => 'required|string|max:255',
        ]);
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }

    protected $casts = ['dateFrom' => 'date:d.m.Y',
        'dateTo' => 'date:d.m.Y',
    ];

    protected $appends = [
        'seit',
        'bis',
        'display',
    ];

    public function getSeitAttribute()
    {
        return Carbon::parse($this->dateFrom)->format('d.m.Y');
    }

    public function setSeitAttribute($value)
    {
        Debugbar::info('VerbrauchsinfoUserEmail-setDateFromEditingAttribute:'. $value);

        $this->dateFrom = Carbon::parse($value);
    }



    public function getBisAttribute()
    {
        if($this->dateTo){
            return Carbon::parse($this->dateTo)->format('d.m.Y');
        }
        return '';
    }

    public function setBisAttribute($value)
    {
        Debugbar::info('VerbrauchsinfoUserEmail-setDateToEditingAttribute:'. $value);
        $value ? $this->dateTo = Carbon::parse($value) : $this->dateTo = null;
    }

   /*  protected function datestart(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d.m.Y'),
            set: fn (string $value) => $value ? Carbon::parse($value) : null,
        );
    }
 */


    public function getZeitraumAttribute(){

        if ($this->dateTo){
            return 'vom '. Carbon::parse($this->dateFrom)->format('d.m.Y') . ' bis '. Carbon::parse($this->dateTo)->format('d.m.Y');
        }else{
            return 'seit '. Carbon::parse($this->dateFrom)->format('d.m.Y') ;
        }

    }

    public function getDisplayAttribute(){
       return $this->email . ' (' . $this->zeitraum . ')';
    }

    protected $dispatchesEvents = [
        'created' => VerbrauchsinfoUserEmailAdded::class,

    ];



}
