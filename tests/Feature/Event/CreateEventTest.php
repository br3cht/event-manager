<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEventTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(RoleEnum::Admin->value);
    }

    /**
     * A basic feature test example.
     */
    public function test_create_event(): void
    {
        $data = [
            'titulo' => 'Teste',
            'descricao' => 'Teste',
            'localizacao' => 'Teste',
            'capacidade_maxima' => 10,
            'horario_inicio' => Carbon::now(),
            'horario_final' => Carbon::now(),
        ];

        $this->actingAs($this->user)
            ->post('/events/create', $data)
            ->assertFound();
    }

    /**
     * A basic feature test example.
     */
    public function test_create_event_not_authorized(): void
    {
        $data = [
            'titulo' => 'Teste',
            'descricao' => 'Teste',
            'localizacao' => 'Teste',
            'capacidade_maxima' => 10,
            'horario_inicio' => Carbon::now(),
            'horario_final' => Carbon::now(),
        ];

        $this->user->syncRoles(RoleEnum::User->value);

        $this->actingAs($this->user)->post('/events/create', $data)->assertForbidden();
    }
}
