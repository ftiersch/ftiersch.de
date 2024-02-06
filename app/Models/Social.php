<?php

namespace App\Models;

use App\Traits\InvalidatesFrontpageCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    use InvalidatesFrontpageCache;

    protected $guarded = [];
}
