<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteEventTest extends TestCase
{
    protected User $user;
    protected Event $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(RoleEnum::Admin->value);
        $this->event = Event::factory()->create();
    }

    public function test_delete_event(): void
    {
        $response = $this->actingAs($this->user)
            ->delete('/events/delete/' . $this->event->id)
            ->assertFound();
    }
}
