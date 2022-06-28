<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Link;
use App\Repository\LinkRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;
use stdClass;

class LinkService
{
    /**
     * @var LinkRepository
     */
    protected LinkRepository $linkRepository;

    /**
     * @param LinkRepository $linkRepository
     */
    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    /**
     * @param string $processedLink
     * @return string
     */
    public function getLink(string $processedLink): string
    {
        $link = $this->linkRepository->findEnabledLink($processedLink);

        $this->checkLink($link);

        $this->linkRepository->updateVisitCounter($processedLink);

        return $link->original_link;
    }

    /**
     * @param Link $link
     * @return void
     */
    private function checkLink(Link $link): void
    {
        $lifeTime = $link->created_at->addHours($link->lifetime);

        if ($link->visit_limit === $link->visit_count || now()->greaterThan($lifeTime)) {
            $this->linkRepository->disableLink($link->processed_link);
            abort(404);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): string
    {
        $processedLink = $this->linkGeneration();

        $this->linkRepository->create($data, $processedLink);

        return $processedLink;
    }

    /**
     * @return string
     */
    private function linkGeneration(): string
    {
        $randomLink = Str::random(8);

        if ($this->linkRepository->findLink($randomLink)) {
            return $this->linkGeneration();
        }

        return $randomLink;
    }
}
