<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CancelSubscriptionTest extends TestCase
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

    public function test_cancel_subscription()
    {
        $this->event->users()->attach($this->user->id);
        $response = $this->actingAs($this->user)->put('/events/cancel-subscription/' . $this->event->id);

        $response->assertStatus(200);
    }
}
