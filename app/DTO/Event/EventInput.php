<?php

namespace App\DTO\Event;

use Carbon\Carbon;

class EventInput
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $location,
        public readonly int $capacity,
        public readonly Carbon $start,
        public readonly Carbon $end,
    ) { }
}
