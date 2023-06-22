<?php

namespace App\Models;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerbrauchsinfoUserEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'realestate_id', 'dateFrom', 'dateTo', 'nutzeinheitNo',
        'neko_id', 'aktiv', 'email', 'webupdate','firstinitUsername', 'date_from_editing',
        'date_to_editing'
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

    protected $appends = ['date_from_editing',
      'date_to_editing'
    ]; 

    public function getDateFromEditingAttribute()
    {
        return Carbon::parse($this->dateFrom)->format('d.m.Y');
    }

    public function setDateFromEditingAttribute($value)
    {
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
        $value ? $this->dateTo = Carbon::parse($value) : $this->dateTo = null;
 
 //       $this->dateTo = Carbon::parse($value);
    }

    public function getZeitraumAttribute(){

        if ($this->dateTo){
            return 'vom '. Carbon::parse($this->dateFrom)->format('d.m.Y') . ' bis '. Carbon::parse($this->dateTo)->format('d.m.Y');
        }else{
            return 'seit '. Carbon::parse($this->dateFrom)->format('d.m.Y') ;
        }

    }


}
