<?php

namespace App\Models;

use App\Enums\ContentPieceType;
use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class ContentPiece extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;
    use InteractsWithMedia;

    public array $translatable = ['text'];

    public $registerMediaConversionsUsingModelInstance = true;

    protected $guarded = [];

    public function scopeInNamespace(Builder $query, string $nameSpace): Builder {
        return $query->where('identifier', 'LIKE', $nameSpace . '%');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (!empty($this->image_conversion_width) || !empty($this->image_conversion_height)) {
            $conversion = $this
                ->addMediaConversion('content')
                ->performOnCollections('image');

            if (!empty($this->image_conversion_width)) {
                $conversion->width($this->image_conversion_width);
            }

            if (!empty($this->image_conversion_height)) {
                $conversion->height($this->image_conversion_height);
            }
        }
    }
}
