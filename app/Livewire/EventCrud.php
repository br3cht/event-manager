<?php

namespace App\Livewire;

use App\DTO\Event\EventInput;
use App\Enum\EventStatus;
use App\Models\Event;
use App\Models\User;
use App\UseCases\Event\Create;
use App\UseCases\Event\Edit;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventCrud extends Component
{
    public $titulo, $descricao, $localizacao, $capacidade_maxima, $horario_inicio, $horario_final, $status,
        $event_id;

    public $isOpen = false;
    public $openParticpants = false;
    public $openDelete = false;
    public $participants;

    public function render()
    {
        $events = Event::paginate();
        $eventStatus = $this->getEnumStatus();

        return view('livewire.event-crud', ['events' => $events, 'eventsStatus' => $eventStatus]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function getEnumStatus()
    {
        return [
            [
                'id' => EventStatus::Open->value,
                'label' => EventStatus::Open->label()
            ],
            [
                'id' => EventStatus::Closed->value,
                'label' => EventStatus::Closed->label()
            ],
            [
                'id' => EventStatus::Canceled->value,
                'label' => EventStatus::Canceled->label()
            ]
        ];
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function showInscriptions(int $event)
    {
        $this->openParticpants = true;
        $this->participants = User::whereHas('events', function($q) use($event){
            return $q->where('event_id', $event);
        })->get();
    }

    public function closeInscriptions()
    {
        $this->openParticpants = false;

        return;
    }

    public function showDelete(int $event)
    {
        $this->openDelete = true;
        $this->event_id = $event;
    }

    public function closeDelete()
    {
        $this->event_id = null;
        $this->openDelete = false;
    }


    private function resetInputFields()
    {
        $this->titulo = '';
        $this->descricao = '';
        $this->localizacao = '';
        $this->capacidade_maxima = '';
        $this->horario_inicio = '';
        $this->horario_final = '';
    }

    public function store()
    {
        $dataRequest = $this->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'localizacao' => 'required|string',
            'status' => 'nullable|string',
            'capacidade_maxima' => 'required|integer',
            'horario_inicio' => 'required|date',
            'horario_final' => 'required|date',
        ]);

        $input = new EventInput(
            title: $dataRequest['titulo'],
            description: $dataRequest['descricao'],
            location: $dataRequest['localizacao'],
            capacity: $dataRequest['capacidade_maxima'],
            start: Carbon::parse($dataRequest['horario_inicio']),
            end: Carbon::parse($dataRequest['horario_final']),
            status: EventStatus::tryFrom($dataRequest['status'])
        );

        $use = resolve(Create::class);
        $use->execute($input);

        $this->resetInputFields();
        $this->closeModal();
    }

    public function edit(int $id)
    {
        $event = Event::find($id);

        $this->event_id = $event->id;
        $this->titulo = $event->titulo;
        $this->status = EventStatus::from($event->status)->value;
        $this->descricao = $event->descricao;
        $this->localizacao = $event->localizacao;
        $this->capacidade_maxima = $event->capacidade_maxima;
        $this->horario_inicio = $event->inicio;
        $this->horario_final = $event->final;

        $this->openModal();
    }

    public function update()
    {
        $dataRequest = $this->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'localizacao' => 'required|string',
            'capacidade_maxima' => 'required|integer',
            'horario_inicio' => 'required|date',
            'horario_final' => 'required|date',
            'status' => 'required|string'
        ]);

        $input = new EventInput(
            title: $dataRequest['titulo'],
            description: $dataRequest['descricao'],
            location: $dataRequest['localizacao'],
            capacity: $dataRequest['capacidade_maxima'],
            start: Carbon::parse($dataRequest['horario_inicio']),
            end: Carbon::parse($dataRequest['horario_final']),
            status: EventStatus::tryFrom($dataRequest['status']),
        );

        $use = resolve(Edit::class);
        $use->execute(Event::find($this->event_id), $input);
        $this->closeModal();
    }

    public function delete()
    {
        Event::find($this->event_id)->delete();
        $this->closeDelete();
    }
}
