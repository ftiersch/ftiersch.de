<?php

namespace App\Models;

use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasFactory;
    use HasTranslations;
    use InvalidatesFrontpageCache;

    public array $translatable = ['name'];
    protected $guarded = [];
}
