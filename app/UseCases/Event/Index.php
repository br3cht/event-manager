<?php

namespace App\UseCases\Event;

use App\Repositories\EventRepository;

class Index
{
    public function __construct(
        private EventRepository $eventRepository
    ) { }

    public function execute()
    {
        return $this->eventRepository->index();
    }
}
