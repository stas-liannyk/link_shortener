<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Services\LinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    /**
     * @var LinkService
     */
    private LinkService $linkService;

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * @param string $processedLink
     * @return RedirectResponse
     */
    public function index(string $processedLink): RedirectResponse
    {
        $link = $this->linkService->getLink($processedLink);

        return redirect($link);
    }

    /**
     * @param LinkRequest $linkRequest
     * @return RedirectResponse
     */
    public function create(LinkRequest $linkRequest): RedirectResponse
    {
        $processedLink = $this->linkService->create($linkRequest->validated());

        return Redirect::back()->with('success', config('app.url') . '/' . $processedLink);
    }
}
