<?php

namespace App\Repositories;

use App\Enums\ProjectType;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Collection;

class ProjectRepository {
    public function getForWebsite(): Collection {
        return Project::query()
            ->with('category')
            ->visibleOnWebsite()
            ->chronologically()
            ->get()
            ->groupBy(function(Project $project) {
                return $project->category->id;
            })
            ->sortBy(fn (Collection $items) => $items->first()->category->sort);
    }
}
