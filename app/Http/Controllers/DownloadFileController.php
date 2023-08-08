<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    private $contentType = '';
    private $subpath = 'public/';


    function downloadFile($file_name){
        return Storage::disk('public')->downloadFile($file_name);
    }

    function showFile($file_name){
        $file = Storage::disk('public')->get($file_name);
        if (str_ends_with($file_name, '.pdf')) { $this->contentType = "application/pdf";}
        if (str_ends_with($file_name, '.jpg')) { $this->contentType = "image/jpeg";}
        return (new Response($file, 200))
              ->header('Content-Type', $this->contentType);
    }
}
