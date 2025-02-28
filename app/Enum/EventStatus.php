<?php

namespace App\Enum;

enum EventStatus: string{
    case Open = 'open';
    case Closed = 'closed';
    case Canceled = 'canceled';
}
