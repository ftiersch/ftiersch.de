<?php

namespace App\Models;

use App\Enums\ContentPieceType;
use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ContentPiece extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;
    use InteractsWithMedia;

    public array $translatable = ['text'];
    protected $guarded = [];

    public function scopeInNamespace(Builder $query, string $nameSpace): Builder {
        return $query->where('identifier', 'LIKE', $nameSpace . '%');
    }

    public function getValueByTypeAttribute() {
        return match ($this->type) {
            ContentPieceType::Html->value, ContentPieceType::Text->value => $this->text,
            ContentPieceType::Image->value => $this->media,
            default => null,
        };
    }
}
