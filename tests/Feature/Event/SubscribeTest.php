<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->actingAs($this->user)
            ->post('/events/subscribe/' . $this->event->id)
            ->assertStatus(200);
    }

    public function test_subscribe_event_error_capacity(): void
    {
        $this->actingAs($this->user)
            ->post('/events/subscribe/' . $this->event->id);

        $this->actingAs($this->user)
            ->post('/events/subscribe/' . $this->event->id)
            ->assertStatus(400);
    }
}
