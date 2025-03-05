<?php

namespace App\UseCases\Event;

use App\Enum\EventStatus;
use App\Events\Event\CapacityReachedEvent;
use App\Exceptions\CapacityReachedException;
use App\Models\Event;
use App\Models\User;
use App\Notifications\SubscribeEvent;
use App\Repositories\EventRepository;
use App\Services\EventService;

class Subscribe
{
    public function __construct(
        private EventRepository $eventRepository
    ) { }

    public function execute(Event $event, User $user): void
    {
        $valiadateCapacity = $this->eventRepository->validateCapacity($event);

        if($valiadateCapacity) {
            event(new CapacityReachedEvent($event, EventStatus::Closed));
            throw new CapacityReachedException();
        }

        $this->eventRepository->subscribe($event, $user);

        $user->notify(new SubscribeEvent($event));
    }
}
