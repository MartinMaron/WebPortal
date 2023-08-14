<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;

class DownloadFileSpacesController extends Controller
{
    public function downloadFile($id){
        return Storage::disk('spaces')->download('app/rechnung/'.$id);

    }

    public function showFile($id){
        $file = Storage::disk('spaces')->get('app/rechnung/'.$id);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response($file, 200, $headers);

    }

}
