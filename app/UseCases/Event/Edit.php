<?php

namespace App\UseCases\Event;

use App\DTO\Event\EventInput;
use App\Models\Event;
use App\Repositories\EventRepository;

class Edit
{
    public function __construct(
        private EventRepository $eventRepository
    ) { }

    public function execute(Event $event,EventInput $input)
    {
        $this->eventRepository->update($event,$input);
    }
}
