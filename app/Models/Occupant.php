<?php

namespace App\Models;
use Carbon\Carbon;
use App\Http\Traits\Helpers;
use App\Models\VerbrauchsinfoCounterMeter;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Occupant extends Model
{
    use HasFactory;
    use Helpers;

    protected $fillable = [
        'nekoId', 'realestate_id', 'unvid', 'budguid','nutzeinheitNo', 'dateFrom', 'dateTo', 'anrede', 'title', 'nachname', 'vorname', 'address', 
        'street', 'postcode', 'houseNr', 'city', 'vat', 'uaw', 'qmkc', 'qmww', 'pe', 'bemerkung', 'vorauszahlung', 'lokalart', 'customEinheitNo', 'lage', 'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class);
    }

    public function counterMeters()
    {
        return $this->hasMany(VerbrauchsinfoCounterMeter::class);
    }

    public function userVerbrauchsinfoAccessControls()
    {
        return $this->hasMany(UserVerbrauchsinfoAccessControl::class);
    }

    public static function validateImportData($data)
    {
        return  Validator::make($data, [
            'nekoId' => 'required|string|max:40',
            'budguid' => 'required|string|max:40',
            'unvid' => 'required|string|max:255',
            'nutzeinheitNo' => 'required|integer',
            'dateFrom' => 'required|date',
            'nachname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'street' => 'sometimes|string',
            'city' => 'sometimes|string',
            'postcode' => 'sometimes|string',
            'houseNr' => 'sometimes',
            'vat' => 'required|boolean',
            'uaw' => 'required|boolean',
            'qmkc' => 'required|numeric',
            'qmww' => 'required|numeric',
            'pe' => 'required|numeric',
            'vorauszahlung' => 'required|numeric',
        ]);

    }



    protected $casts = ['dateFrom' => 'date:d.m.Y',
                        'dateTo' => 'date:d.m.Y',
                        'qmkc' => 'decimal:2',
                        'vorauszahlung' => 'decimal:2' ];

    protected $appends = ['date_from_editing',
                          'date_to_editing',
                          'vorauszahlung_editing',
                          'qmkc_editing'];


    public function getDateFromEditingAttribute()
    {
        return Carbon::parse($this->dateFrom)->format('d.m.Y');
    }

    public function setDateFromEditingAttribute($value)
    {
        Debugbar::info('Occupant-setDateFromEditingAttribute:'. $value);
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


    public function setQmkcEditingAttribute($value){
         $this->qmkc = $this->castStringToDouble($value);
    }

    public function getQmkcEditingAttribute(){
        return number_format($this->qmkc, 2, ',', '.');
    }

    public function setVorauszahlungEditingAttribute($value){
        $this->vorauszahlung = $this->castStringToDouble($value);
    }

    public function getVorauszahlungEditingAttribute(){
        return number_format($this->vorauszahlung, 2, ',', '.');
    }

    public function getZeitraumAttribute(){

        if ($this->dateTo){
            return Carbon::parse($this->dateFrom)->format('DD.MM.YYYY') . ' - '. Carbon::parse($this->dateTo)->format('DD.MM.YYYY');
        }else{
            return Carbon::parse($this->dateFrom)->format('DD.MM.YYYY') . ' - __.__.____';
        }

    }

    public function getNutzerKennnummerAttribute()
    {
        return substr($this->unvid,12,3). '-'. substr($this->unvid,15,3);
    }


    public function getNutzerMitLageAttribute(){
        if ($this->lage){
            return $this->getNutzerKennnummerAttribute() . ": ". $this->lage ;
        }
        else {
            return $this->getNutzerKennnummerAttribute() ;
        }
    }

    public function verbrauchsinfos()
    {
        return $this->hasMany(Verbrauchsinfo::class);
    }



}
