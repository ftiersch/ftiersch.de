<?php
namespace App\Enums;

enum ContentPieceType: string
{
    case Text = 'text';
    case Html = 'html';
    case Image = 'image';

    public static function options(): array {
        return [
            self::Text->value   => 'Text',
            self::Html->value   => 'HTML',
            self::Image->value  => 'Bild',
        ];
    }
}
