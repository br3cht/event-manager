<?php

namespace App\Enum;

enum EventStatus: string{
    case Open = 'open';
    case Closed = 'closed';
    case Canceled = 'canceled';
    case Finished = 'finished';

    public function label(): string
    {
        return match ($this) {
            EventStatus::Open => 'Aberto',
            EventStatus::Closed => 'Fechado',
            EventStatus::Canceled => 'Cancelado',
            EventStatus::Finished => 'finalizado',
        };
    }
}
