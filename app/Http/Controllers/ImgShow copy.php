<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;



class ImgShow extends Controller
{

    function showImg($file_name){
        $file = Storage::disk('spaces')->get('app/img/home/'.$file_name);
        $headers = [
            'Content-Type' => "image/jpeg",
        ];

        return response($file, 200, $headers);    }

}
