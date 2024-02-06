<?php

namespace App\Http\Controllers;

use App\Enums\CacheKey;
use App\Repositories\ContentPieceRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SkillRepository;
use App\Repositories\SocialRepository;
use App\Services\ContentPieceService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke(
        ProjectRepository $projectRepo,
        SkillRepository $skillRepo,
        ServiceRepository $serviceRepo,
        SocialRepository $socialRepo,
        ContentPieceService $contentPieceService
    )
    {
        $content = cache()->get(CacheKey::Frontpage);

        if (!$content || app()->environment('local')) {
            $projectGroups = $projectRepo->getForWebsite();
            $skills = $skillRepo->getForWebsite();
            $services = $serviceRepo->getForWebsite();
            $socials = $socialRepo->getForWebsite();
            $contentPieceService->loadNamespace('frontpage');

            $content = view('new.index_new', compact("projectGroups", "skills", "services", "socials"))->render();

            cache()->put(CacheKey::Frontpage, $content);
        }

        return response($content);
    }
}
