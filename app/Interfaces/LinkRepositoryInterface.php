<?php

namespace App\Interfaces;

interface LinkRepositoryInterface
{
    public function findEnabledLink($processedLink);
    public function findLink($processedLink);
    public function updateVisitCounter($link);
    public function disableLink($link);
    public function create(array $data, string $processedLink);
}
