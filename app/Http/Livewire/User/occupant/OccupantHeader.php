<?php

namespace app\Http\Livewire\User\Occupant;
use App\Models\Occupant;
use Livewire\Component;
use Livewire\HydrationMiddleware\AddAttributesToRootTagOfHtml;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;
use Symfony\Component\HttpKernel\DependencyInjection\AddAnnotatedClassesToCachePass;

class OccupantHeader extends Component
{


    git remote add live ssh://root@104.248.18.246/var/repo/html.git

    public $occupant;
    public $showStandardIcon = true;
    public $addAction = null;

    public function mount(Occupant $occupant)
    {
        $this->occupant = $occupant;
        if ($this->addAction != null)
        {
            $this->showStandardIcon = false;
        }
    }

    public function raise_CreateVerbrauchsinfoUserEmailModal()
    {
        $this->emit($this->addAction, $this->occupant->nutzeinheitNo);
    }

    public function render()
    {
        return view('livewire.user.occupant.occupant-header');
    }
}
