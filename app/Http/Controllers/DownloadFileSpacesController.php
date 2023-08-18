<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;

class DownloadFileSpacesController extends Controller
{
    function  downloadFile($folder,$id,$file_name){
        return Storage::disk('spaces')->download($folder,$id,$file_name);

    }

    function  showFile($folder,$id,$file_name){
        $file = Storage::disk('spaces')->get($folder,$id,$file_name);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response($file, 200, $headers);

    }

}
