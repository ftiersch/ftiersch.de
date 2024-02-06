<?php

namespace App\Models;

use App\Enums\ProjectType;
use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;

    public $translatable = ['title', 'description', 'location'];

    public $casts = [
        'type' => ProjectType::class,
        'started_at' => 'date',
        'finished_at' => 'date',
    ];

    protected $guarded = [];

    // TODO:test
    public function scopeVisibleOnWebsite(Builder $query): Builder {
        return $query->where('visible_on_website', 1);
    }

    // TODO:test
    public function scopeChronologically(Builder $query): Builder {
        return $query
            ->orderBy('started_at', 'DESC')
            ->orderBy('finished_at', 'DESC');
    }
}
