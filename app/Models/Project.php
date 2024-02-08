<?php

namespace App\Models;

use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;

    public $translatable = ['title', 'description', 'location'];

    public $casts = [
        'started_at' => 'date',
        'finished_at' => 'date',
    ];

    protected $guarded = [];

    public function category(): BelongsTo {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

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
