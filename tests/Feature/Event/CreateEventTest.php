<?php

namespace Tests\Feature\Event;

use App\Enum\RoleEnum;
use App\Livewire\EventCrud;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
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

        Livewire::actingAs($this->user)
            ->test(EventCrud::class, $data)
            ->call('store');

        $this->assertDatabaseCount('events', 1);
    }
}
