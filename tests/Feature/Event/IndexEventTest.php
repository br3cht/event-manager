<?php

namespace Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexEventTest extends TestCase
{
    public function test_index_event(): void
    {
        $this->get('/events')
            ->assertOk();
    }
}
