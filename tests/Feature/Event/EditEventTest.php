<?php

namespace Tests\Feature\Event;

use App\Enum\EventStatus;
use App\Enum\RoleEnum;
use App\Livewire\EventCrud;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
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
            'status' => EventStatus::Canceled->value,
            'event_id' => $this->event->id
        ];

        Livewire::actingAs($this->user)
            ->test(EventCrud::class, $data)
            ->call('update');

        $this->assertDatabaseHas('events', [
            'id' => $this->event->id,
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'],
            'localizacao' => $data['localizacao'],
            'capacidade_maxima' => $data['capacidade_maxima'],
            'inicio' => $data['horario_inicio'],
            'final' => $data['horario_final'],
            'status' => $data['status']
        ]);
    }
}
