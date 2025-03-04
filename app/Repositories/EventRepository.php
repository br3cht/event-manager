<?php

namespace App\Repositories;

use App\DTO\Event\EventInput;
use App\Enum\EventStatus;
use App\Models\Event;
use App\Models\Participant;
use App\Models\User;

class EventRepository
{
    public function index()
    {
        return Event::paginate(10);
    }

    public function store(EventInput $input): void
    {
         Event::create([
            'status' => EventStatus::Open,
            'titulo' => $input->title,
            'descricao' => $input->description,
            'localizacao' => $input->location,
            'capacidade_maxima' => $input->capacity,
            'inicio' => $input->start,
            'final' => $input->end
        ]);
    }

    public function update(Event $event,EventInput $input): void
    {
        $dataUpdate = [
            'titulo' => $input->title ?? $event->title,
            'descricao' => $input->description,
            'localizacao' => $input->location ?? $event->location,
            'capacidade_maxima' => $input->capacity ?? $event->capacity,
            'inicio' => $input->start ?? $event->start,
            'final' => $input->end ?? $event->end
        ];

        if(!empty($input->status)) {
            $dataUpdate['status'] = $input->status;
        }

        $event->update($dataUpdate);
    }

    public function subscribe(Event $event, User $user): void
    {
        Participant::create([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);
    }

    public function validateIfUserIsParticipant(Event $event, User $user): bool
    {
        return Participant::where('event_id', $event->id)->where('user_id', $user->id)->exists();
    }

    public function validateCapacity(Event $event): bool
    {
        return Participant::where('event_id', $event->id)->count() >= $event->capacidade_maxima;
    }
}
