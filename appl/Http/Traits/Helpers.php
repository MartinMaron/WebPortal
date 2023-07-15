<?php
namespace App\Http\Traits;

trait Helpers
{
    public function castStringToDouble($value){
        if($value){     
            $tvalue = str_replace('.','@', $value);
            $tvalue = str_replace(',','.', $tvalue);
            $tvalue = str_replace('@','', $tvalue);
            return floatval($tvalue);
        }
        return null;
    }
}
