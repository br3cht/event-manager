<?php

namespace App\Livewire;

use App\Models\Event;
use App\UseCases\Event\Subscribe;
use Livewire\Component;

class Events extends Component
{
    public $isOpen = false;
    public $isOpenRegister = false;

    public function openModal()
    {
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
