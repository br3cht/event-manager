<?php

namespace App\UseCases\Event;

use App\DTO\Event\EventInput;
use App\Repositories\EventRepository;

class Create
{
    public function __construct(
        private EventRepository $eventRepository
    )
    { }

    public function execute(EventInput $input)
    {
        $this->eventRepository->store($input);
    }
}
