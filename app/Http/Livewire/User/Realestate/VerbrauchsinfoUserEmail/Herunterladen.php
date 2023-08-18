<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;



class Herunterladen extends Component
{
    public Invoice $invoice;

    public function mount($invoice)
    {
        $this->invoice = $invoice;
    }

    public function downloadFile($folder,$id,$file_name){
        return Storage::disk('spaces')->download($folder,$id,$file_name);

    }

    public function showFile($folder,$id,$file_name){
        $file = Storage::disk('spaces')->get($folder,$id,$file_name);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response($file, 200, $headers);

    }

    public function render()
    {
        $invoices = Invoice::all();

        return view('livewire.user.realestate.herunterladen', ['invoices' => $invoices]);
    }
}
