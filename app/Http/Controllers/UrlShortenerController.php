<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlCreateRequest;
use App\UrlShortener\Services\UrlShortenerService;

class UrlShortenerController extends Controller
{
    private $urlShortenerService;

    public function __construct(UrlShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    public function create()
    {
        return view('urlshortener.create');
    }

    public function store(UrlCreateRequest $urlCreateRequest)
    {
        $url = $this->urlShortenerService->shorten($urlCreateRequest->input('url'));

        return view('urlshortener.created', [
            'url' => $url
        ]);
    }

    public function redirectShortUrl($path)
    {
        $this->urlShortenerService->logVisit($path);

        return redirect($this->urlShortenerService->getRedirectPath($path));
    }
}
