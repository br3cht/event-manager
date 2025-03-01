<?php

namespace App\Http\Controllers;

use App\DTO\Event\EventInput;
use App\Http\Requests\StoreEventRequest;
use App\UseCases\Event\Create;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        return view('event.index');
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
        );

        $use->execute($input);

        return redirect('/');
    }
}
