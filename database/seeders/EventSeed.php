<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Event::count() != 0) {
            return;
        }

        Event::factory()->count(10)->create();
    }
}
