<?php

namespace App\Livewire;

use App\Models\Event;
use App\UseCases\Event\CancelSubscription;
use Livewire\Component;

class MyEvents extends Component
{
    public $isOpen = false;
    public $eventId;

    public function openModal(int $id)
    {
        $this->eventId = $id;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->eventId = null;
        $this->isOpen = false;
    }

    public function cancelSubscription()
    {
        $event = Event::find($this->eventId);
        $cancelSubscription = resolve(CancelSubscription::class);

        $cancelSubscription->execute($event, auth()->user());

        $this->closeModal();
    }

    public function render()
    {
        $user = auth()->user();
        $events = $user->events()->paginate();

        return view('livewire.my-events', ['events' => $events]);
    }
}
