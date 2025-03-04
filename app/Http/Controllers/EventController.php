<?php

namespace App\Http\Controllers;

use App\DTO\Event\EventInput;
use App\Enum\EventStatus;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\UseCases\Event\Create;
use App\UseCases\Event\Edit;
use App\UseCases\Event\Index;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class EventController extends Controller
{
    public function subscribe(Event $event)
    {
        return response()->json(['message' => 'Inscricao realizada com sucesso'], 200);
    }

    public function index(Request $request)
    {
        $user = resolve(Index::class);
        $events = $user->execute();

        return view('event.index', ['events' => $events]);
    }

    public function store(StoreEventRequest $request)
    {
        $dataRequest = $request->validated();
        $use = resolve(Create::class);

        $input = new EventInput(
            title: $dataRequest['titulo'],
            description: $dataRequest['descricao'],
            location: $dataRequest['localizacao'],
            capacity: $dataRequest['capacidade_maxima'],
            start: $dataRequest['horario_inicio'],
            end: $dataRequest['horario_final'],
            status: null
        );

        $use->execute($input);

        return redirect('/');
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $dataRequest = $request->validated();
        $use = resolve(Edit::class);
        $eventStatus = EventStatus::tryFrom($dataRequest['status']);

        $input = new EventInput(
            title: $dataRequest['titulo'],
            description: $dataRequest['descricao'],
            location: $dataRequest['localizacao'],
            capacity: $dataRequest['capacidade_maxima'],
            start: $dataRequest['horario_inicio'],
            end: $dataRequest['horario_final'],
            status: $eventStatus,
        );

        $use->execute($event,$input);

        return response()->json(['message' => 'evento Atualizado com sucesso'], 200);
    }

    public function edit()
    {
        return view('event.edit');
    }

    public function delete(Request $request, Event $event)
    {
        $event->delete();

        return redirect('/events');
    }
}
