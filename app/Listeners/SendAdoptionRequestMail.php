<?php

namespace App\Listeners;

use App\Events\AdoptionRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdoptionRequestMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdoptionRequest $event): void
    {
        Mail::to(config('mail.from.address'))
            ->queue(new AdoptionRequestMail($event->request));
    }
}
