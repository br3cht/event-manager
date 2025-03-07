<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Events\Event\CapacityReachedEvent;
use App\Livewire\Events;
use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    protected User $user;
    protected Event $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(RoleEnum::User->value);
        $this->event = Event::factory()->state(['capacidade_maxima' => 1])->create();
    }

    public function test_subscribe_event(): void
    {
        Livewire::actingAs($this->user)
            ->test(Events::class, ['eventId' => $this->event->id])
            ->call('subscribe');

        $this->assertDatabaseCount('participants', 1);
    }

    public function test_subscribe_event_error_capacity(): void
    {
        Livewire::actingAs($this->user)
            ->test(Events::class, ['eventId' => $this->event->id])
            ->call('subscribe');

        Livewire::actingAs($this->user)
            ->test(Events::class, ['eventId' => $this->event->id])
            ->call('subscribe')
            ->assertSet('openMessageError', true);
    }
}
