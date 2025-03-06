<?php

namespace App\Livewire;

use App\Models\Event;
use App\UseCases\Event\Subscribe;
use Livewire\Component;

class Events extends Component
{
    public $eventId;
    public $isOpen = false;
    public $isOpenRegister = false;

    public function openModal(int $id)
    {
        $this->eventId = $id;
        $this->isOpen = true;
    }

    public function openModalRegister()
    {
        $this->isOpenRegister = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenRegister = false;
    }

    public function subscribe()
    {
        $event = Event::find($this->eventId);
        $user = auth()->user();

        $subscribe = resolve(Subscribe::class);

        $subscribe->execute($event, $user);

        $this->closeModal();
    }

    public function render()
    {
        $events = Event::paginate();

        return view('livewire.events', ['events' => $events]);
    }
}
