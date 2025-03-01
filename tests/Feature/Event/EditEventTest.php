<?php

namespace Tests\Feature\Event;

use App\Enum\EventStatus;
use App\Enum\RoleEnum;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditEventTest extends TestCase
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

    public function test_edit_event()
    {
        $data = [
            'titulo' => 'Teste',
            'descricao' => 'Teste',
            'localizacao' => 'Teste',
            'capacidade_maxima' => 10,
            'horario_inicio' => Carbon::now(),
            'horario_final' => Carbon::now(),
            'status' => EventStatus::Canceled->value
        ];

        $this->actingAs($this->user)
            ->put('/events/edit/' . $this->event->id, $data)
            ->assertOk();
    }
}
