<?php

namespace App\Models;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerbrauchsinfoUserEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'realestate_id', 'dateFrom', 'dateTo', 'nutzeinheitNo',
        'neko_id', 'aktiv', 'email', 'webupdate','firstinitUsername'
    ];


    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }

    protected $casts = ['dateFrom' => 'date:d.m.Y',
        'dateTo' => 'date:d.m.Y',
    ];

    protected $appends = ['date_from_editing',
      'date_to_editing'
    ];

    public function getDateFromEditingAttribute()
    {
        return Carbon::parse($this->dateFrom)->format('d.m.Y');
    }

    public function setDateFromEditingAttribute($value)
    {
        Debugbar::info('VerbrauchsinfoUserEmail-setDateFromEditingAttribute:'. $value);
        $this->dateFrom = Carbon::parse($value);
    }

    public function getDateToEditingAttribute()
    {
        if($this->dateTo){
            return Carbon::parse($this->dateTo)->format('d.m.Y');
        }
        return '';
    }

    public function setDateToEditingAttribute($value)
    {
        $this->dateTo = Carbon::parse($value);
    }

    public function getZeitraumAttribute(){

        if ($this->dateTo){
            return Carbon::parse($this->dateFrom)->format('DD.MM.YYYY') . ' - '. Carbon::parse($this->dateTo)->format('DD.MM.YYYY');
        }else{
            return Carbon::parse($this->dateFrom)->format('DD.MM.YYYY') . ' - __.__.____';
        }

    }


}
