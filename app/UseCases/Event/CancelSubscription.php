<?php

namespace App\UseCases\Event;

use App\Enum\EventStatus;
use App\Events\Event\CapacityReachedEvent;
use App\Models\Event;
use App\Models\User;
use App\Notifications\CancelSubscribeEvent;
use App\Repositories\EventRepository;

class CancelSubscription
{
    public function __construct(
        private EventRepository $eventRepository
    ) {}

    public function execute(Event $event, User $user): void
    {
        if (!$this->eventRepository->validateIfUserIsParticipant($event, $user)) {
            return;
        }

        $this->eventRepository->cancelSubscribe($event, $user);

        $event->fresh();

        $valiadateCapacity = $this->eventRepository->validateCapacity($event);
        if(!$valiadateCapacity) {
            event(new CapacityReachedEvent($event, EventStatus::Open));
        }

        $user->notify(new CancelSubscribeEvent($event));
    }
}
