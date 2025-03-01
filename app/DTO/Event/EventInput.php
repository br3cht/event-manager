<?php

namespace App\DTO\Event;

use App\Enum\EventStatus;
use Carbon\Carbon;

class EventInput
{
    public function __construct(
        public readonly string $title,
        public readonly string|null $description,
        public readonly string $location,
        public readonly int $capacity,
        public readonly Carbon $start,
        public readonly Carbon $end,
        public readonly EventStatus|null $status,
    ) { }
}
