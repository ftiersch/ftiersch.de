<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Support\Collection;

class SkillRepository {
    public function getForWebsite(): Collection {
        return Skill::query()
            ->orderBy('sort', 'DESC')
            ->get();
    }
}
