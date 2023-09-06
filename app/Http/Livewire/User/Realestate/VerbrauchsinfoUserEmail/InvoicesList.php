<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;



class InvoicesList extends Component
{

    public $realestate;

    public function path($folder)
    {
      $folder = 'app/realestates/'.$realestate->nekoId.'invoices/'.$invoices->fileName;
      return $this->$folder;
    }

    public function mount($realestate)
    {
        $this->realestate->$realestate;
    }


    public function render()
    {
        $invoices = Invoice::all();

        return view('livewire.user.realestate.invoices-list', ['invoices' => $invoices]);
    }
}
