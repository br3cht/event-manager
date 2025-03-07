<?php

namespace App\Services;

use App\Enum\EventStatus;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Support\Collection;

class EventService
{
    public function __construct(
        private EventRepository $eventRepository
    )
    { }

    public function finisheEvent(): Collection
    {
        $events = $this->eventRepository->getEventsNeedFinished();

        foreach($events as $event) {
            $this->eventRepository->updateStatus($event, EventStatus::Finished);
        }
    }
}
