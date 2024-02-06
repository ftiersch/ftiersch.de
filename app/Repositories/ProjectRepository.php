<?php

namespace App\Repositories;

use App\Enums\ProjectType;
use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository {
    public function getForWebsite(): Collection {
        return Project::query()
            ->visibleOnWebsite()
            ->chronologically()
            ->get()
            ->groupBy('type')
            ->sortBy(fn (Collection $items, string $type) => ProjectType::from($type)->order());
    }
}
