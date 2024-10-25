<?php

namespace App\Listeners;

use App\Events\CostAmountAdded;
use Usernotnull\Toast\Concerns\WireToast;

class CostAmountAddedNotification
{
    use WireToast;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CostAmountAdded $event
     * @return void
     */
    public function handle(CostAmountAdded $event): void
    {
        toast()->success('Betrag '. $event->costAmount->brutto. ' € hinzugefügt' ,'Achtung')->push();
    }
}
