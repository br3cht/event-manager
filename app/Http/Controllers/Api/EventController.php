<?php

namespace App\Http\Controllers\Api;

use App\DTO\Event\EventInput;
use App\Enum\EventStatus;
use App\Exceptions\CapacityReachedException;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\UseCases\Event\CancelSubscription;
use App\UseCases\Event\Create;
use App\UseCases\Event\Edit;
use App\UseCases\Event\Index;
use App\UseCases\Event\Subscribe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $user = resolve(Index::class);
        $events = $user->execute();

        return EventResource::collection($events);
    }

    public function show(Request $request, Event $event)
    {
        return new EventResource($event);
    }

    public function subscribe(Request $request, Event $event)
    {
        try {
            $use = resolve(Subscribe::class);
            $user = $request->user();

            $use->execute($event, $user);

            return response()->json(['message' => 'Inscricao realizada com sucesso'], 200);
        } catch (CapacityReachedException $exception) {

            return response()->json(['message' => 'Capacidade Maxima Atingida'], 400);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), [
                $exception->getTraceAsString()
            ]);

            return response()->json(['message' => 'Erro de Servidor'], 500);
        }
    }

    public function cancelSubscribe(Request $request, Event $event)
    {
        $use = resolve(CancelSubscription::class);
        $user = $request->user();

        $use->execute($event, $user);

        return response()->json(['message' => 'Inscricao cancelada com sucesso'], 200);
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

        return response()->json(['message' => 'Evento Criado com Sucesso'], 200);
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

        $use->execute($event, $input);

        return response()->json(['message' => 'evento Atualizado com sucesso'], 200);
    }
}
