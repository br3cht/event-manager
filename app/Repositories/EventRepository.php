<?php

namespace App\Repositories;

use App\DTO\Event\EventInput;
use App\Enum\EventStatus;
use App\Models\Event;
use App\Models\User;

class EventRepository
{
    public function index()
    {
        return Event::pagineted(10);
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
}
