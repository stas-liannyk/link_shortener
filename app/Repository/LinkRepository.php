<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Models\Link;

class LinkRepository
{
    /**
     * @param string $processedLink
     * @return Link
     */
    public function findEnabledLink(string $processedLink): Link
    {
        return Link::where('is_enabled', true)
            ->where('processed_link', $processedLink)
            ->firstOrFail();
    }

    /**
     * @param string $processedLink
     * @return Link
     */
    public function findLink(string $processedLink): ?Link
    {
        return Link::where('processed_link', $processedLink)->first();
    }

    /**
     * @param string $processedLink
     * @return void
     */
    public function updateVisitCounter(string $processedLink): void
    {
        Link::where('processed_link', $processedLink)->increment('visit_count');
    }

    /**
     * @param string $processedLink
     * @return void
     */
    public function disableLink(string $processedLink): void
    {
        Link::where('processed_link', $processedLink)->update(['is_enabled' => false]);
    }

    /**
     * @param array $data
     * @param string $processedLink
     * @return void
     */
    public function create(array $data, string $processedLink): void
    {
        Link::create([
            'original_link' => $data['original_link'],
            'processed_link'  => $processedLink,
            'visit_limit'  => $data['visit_limit'],
            'lifetime'  => $data['lifetime'],
        ]);
    }
}
