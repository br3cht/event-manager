<?php

namespace App\Livewire;

use Livewire\Component;

class MyEvents extends Component
{
    public function render()
    {
        $user = auth()->user();
        $events = $user->events()->paginate();

        return view('livewire.my-events', ['events' => $events]);
    }
}
