<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;




class InvoicesList extends Component
{
    public $realestate;
    public $filters = [
        'search' => '',
    ];


    public function path($folder)
    {
      $folder = 'app/realestates/'.$realestate->nekoId.'invoices/'.$invoices->fileName;
      return $this->$folder;
    }

    public function mount($realestate)
    {
        $this->realestate->$realestate;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        if ($this->filters['search']) {
            $result = Invoice::query()
                ->where('realestate_id', '=', $this->realestate->id)
                ->where(function (Builder $query) {
                    $query->where('caption', 'LIKE', '%' . $this->filters['search'] . '%')
                        ->orWhere('fileName', 'LIKE', '%' . $this->filters['search'] . '%');
                });
        } else {
            $result = Invoice::query()
                ->where('realestate_id', '=', $this->realestate->id);
        };


        return $result;
    }


    public function render()
    {
        $invoices = Invoice::all();

        return view('livewire.user.realestate.invoices-list', ['invoices' => $invoices]);
    }
}
