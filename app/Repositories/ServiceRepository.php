<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Collection;

class ServiceRepository {
    public function getForWebsite(): Collection {
        return Service::query()
            ->orderBy('sort', 'DESC')
            ->get();
    }
}
