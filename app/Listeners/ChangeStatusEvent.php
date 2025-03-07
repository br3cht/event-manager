<?php

namespace App\Listeners;

use App\Repositories\EventRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatusEvent
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
    public function handle(object $object): void
    {
        $event = $object->event;
        $repository = resolve(EventRepository::class);
        $repository->updateStatus($event, $object->status);
    }
}
