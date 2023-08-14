<?php

namespace App\Http\Livewire\User\Realestate\VerbrauchsinfoUserEmail;

use Livewire\Component;
use App\Models\Realestate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnArgument;


class Herunterladen extends Component
{


    public Realestate $realestate;

    public function mount($realestate)
    {
        $this->realestate = $realestate;
    }

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

    public function render()
    {
        return view('livewire.user.realestate.herunterladen');
    }
}
