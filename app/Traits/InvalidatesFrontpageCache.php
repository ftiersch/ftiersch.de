<?php

namespace App\Traits;

use App\Enums\CacheKey;
use Illuminate\Database\Eloquent\Model;

trait InvalidatesFrontpageCache {
    protected static function bootInvalidatesFrontpageCache() {
        static::saved(function (Model $model) {
            cache()->forget(CacheKey::Frontpage);
        });

        static::deleted(function (Model $model) {
            cache()->forget(CacheKey::Frontpage);
        });
    }
}
