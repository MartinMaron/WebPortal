<?php

namespace App\Models;

use Carbon\Carbon;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
 use App\Events\VerbrauchsinfoUserEmailAdded;

class VerbrauchsinfoUserEmail extends Model
{

    protected $fillable = [
        'realestate_id', 'dateFrom', 'dateTo', 'nutzeinheitNo',
        'email', 'firstinitUsername', 'seit','bis'
    ];


    public static function validateImportData($data) {
        return Validator::make($data, [
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

    protected $dispatchesEvents = [
        'created' => VerbrauchsinfoUserEmailAdded::class,
    ];
}
