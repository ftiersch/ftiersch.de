<?php

namespace App\Repositories;

use App\Models\Social;
use Illuminate\Support\Collection;

class SocialRepository {
    public function getForWebsite(): Collection {
        return Social::query()
            ->orderBy('sort', 'DESC')
            ->get();
    }
}
