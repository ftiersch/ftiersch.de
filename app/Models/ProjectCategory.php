<?php

namespace App\Models;

use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ProjectCategory extends Model
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;

    public $translatable = ['title'];

    protected $guarded = [];

    public function projects(): HasMany {
        return $this->hasMany(Project::class, 'project_category_id');
    }
}
