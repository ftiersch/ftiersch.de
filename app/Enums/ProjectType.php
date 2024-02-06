<?php
namespace App\Enums;

enum ProjectType: string
{
    case Education = 'education';
    case Professional = 'professional';
    case Freelance = 'freelance';

    public function label(): string
    {
        return match($this) {
            static::Education => 'Schulischer Werdegang',
            static::Professional => 'Beruflicher Werdegang',
            static::Freelance => 'Freiberufliche Projekte',
        };
    }

    public function order(): int
    {
        return match($this) {
            static::Freelance => 0,
            static::Professional => 1,
            static::Education => 2,
        };
    }
}
