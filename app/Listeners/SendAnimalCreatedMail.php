<?php

namespace App\Listeners;

use App\Events\AnimalCreated;
use App\Mail\AnimalCreatedMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAnimalCreatedMail
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
    public function handle(AnimalCreated $event): void
    {
        $admins = User::where('role', 'admin')->pluck('email');
        Mail::to($admins)->queue(
            new AnimalCreatedMail($event->animal)
        );
    }
}
