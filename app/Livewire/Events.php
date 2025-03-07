<?php

namespace App\Livewire;

use App\Enum\EventStatus;
use App\Enum\RoleEnum;
use App\Exceptions\CapacityReachedException;
use App\Models\Event;
use App\UseCases\Event\Subscribe;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Events extends Component
{
    use WithPagination;

    public $eventId;
    public $isOpen = false;
    public $isOpenRegister = false;
    public $openMessageError = false;

    public function mount()
    {
        if ($this->redirectToDashboard()) {
            return redirect()->route('eventos');
        }
    }

    private  function redirectToDashboard()
    {
        $user = auth()->user();
        if(empty($user)){
            return false;
        }
        $role = $user->roles->first()->name;
        return $role == RoleEnum::Admin->value;
    }

    public function openModal(int $id)
    {
        if(!auth()->user()){
            return redirect('/login');
        }

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
        $this->openMessageError = false;
    }

    public function subscribe()
    {
        $event = Event::find($this->eventId);
        $user = auth()->user();

        try {
            $subscribe = resolve(Subscribe::class);
            $subscribe->execute($event, $user);

            $this->closeModal();
        } catch (CapacityReachedException $exception) {
            $this->closeModal();
            $this->openMessageError = true;
        }
    }

    public function render()
    {
        if($this->redirectToDashboard()){
            return redirect('eventos');
        }

        $events = Event::paginate(5);
        return view('livewire.events', ['events' => $events]);
    }
}
