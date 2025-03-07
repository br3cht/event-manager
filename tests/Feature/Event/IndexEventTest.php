<?php

namespace Tests\Feature\Event;

use App\Livewire\Events;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexEventTest extends TestCase
{
    public function test_index_event(): void
    {
        Livewire::test(Events::class)
            ->assertViewIs('livewire.events');
    }
}
