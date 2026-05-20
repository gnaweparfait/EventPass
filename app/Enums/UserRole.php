<?php

namespace App\Enums;

enum UserRole: string
{
    case Organisateur = 'organisateur';
    case Participant = 'participant';

    public function label(): string
    {
        return match ($this) {
            self::Organisateur => 'Organisateur',
            self::Participant => 'Participant',
        };
    }
}
