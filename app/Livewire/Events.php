<?php

namespace App\Livewire;

use App\Models\Event;
use App\UseCases\Event\Subscribe;
use Livewire\Component;

class Events extends Component
{
    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function subscribe(int $id)
    {
        $event = Event::find($id);
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
