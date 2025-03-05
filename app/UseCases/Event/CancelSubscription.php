<?php

namespace App\UseCases\Event;

use App\Models\Event;
use App\Models\User;
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
    }
}
