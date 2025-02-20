<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Abrechnungssetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;



class DownloadFileSpacesController extends Controller
{

    function  downloadFile($param){
        if (auth()->user()->isUser){
            if (str_starts_with($param, 'i'))
            {
                $parts = explode('+',$param);
                $invoice = Invoice::find($parts[1] );
                $path = 'app/realestates/'. $invoice->realestate->nekoId. '/invoices/'. $invoice->fileName;
                return Storage::disk('spaces')->download($path);
            }
            if (str_starts_with($param, 'abrhk_kosten'))
            {
                $parts = explode('+',$param);
                $obj = Abrechnungssetting::find($parts[1]);
                $path = 'app/realestates/'. $obj->realestate->nekoId. '/HK_ABR/'. $obj->hk_id. '/KOSTENUEBERSICHT.pdf';
                return Storage::disk('spaces')->download($path);
            }
        }else{
            return redirect('/dashboard'); 
        }
    }

    function  showFile($param){
        if (auth()->user()->isUser){
            $parts = explode('-',$param);
            $invoice = Invoice::find($parts[1] );
            $path = 'app/realestates/'. $invoice->realestate->nekoId. '/invoices/'. $invoice->fileName;

            $file = Storage::disk('spaces')->get($path);
            $headers = [
                'Content-Type' => 'application/pdf',
            ];
        return response($file, 200, $headers);
        }else{
            return redirect('/dashboard'); 
    }

    }

}
