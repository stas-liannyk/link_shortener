<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Models\Link;
use Illuminate\Database\Eloquent\Model;

class LinkRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->model = $link;
    }

    /**
     * @param string $processedLink
     * @return Link
     */
    public function findEnabledLink(string $processedLink): Link
    {
        return $this->model->where('is_enabled', true)
            ->where('processed_link', $processedLink)
            ->firstOrFail();
    }

    /**
     * @param string $processedLink
     * @return Link
     */
    public function findLink(string $processedLink): ?Link
    {
        return $this->model->where('processed_link', $processedLink)->first();
    }

    /**
     * @param string $processedLink
     * @return void
     */
    public function updateVisitCounter(string $processedLink): void
    {
        $this->model->where('processed_link', $processedLink)->increment('visit_count');
    }

    /**
     * @param string $processedLink
     * @return void
     */
    public function disableLink(string $processedLink): void
    {
        $this->model->where('processed_link', $processedLink)->update(['is_enabled' => false]);
    }

    /**
     * @param array $data
     * @param string $processedLink
     * @return void
     */
    public function create(array $data, string $processedLink): void
    {
        $this->model::create([
            'original_link' => $data['original_link'],
            'processed_link'  => $processedLink,
            'visit_limit'  => $data['visit_limit'],
            'lifetime'  => $data['lifetime'],
        ]);
    }
}
