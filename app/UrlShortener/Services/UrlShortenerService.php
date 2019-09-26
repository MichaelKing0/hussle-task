<?php

namespace App\UrlShortener\Services;

use App\UrlShortener\Models\Url;
use App\UrlShortener\Repositories\UrlRepository;
use App\UrlShortener\Shorteners\ShortenerInterface;
use Illuminate\Support\Collection;

class UrlShortenerService
{
    private $urlRepository;
    private $shortener;

    public function __construct(UrlRepository $urlRepository, ShortenerInterface $shortener)
    {
        $this->urlRepository = $urlRepository;
        $this->shortener = $shortener;
    }

    public function shorten($url): Url
    {
        // Create the entry in the DB first so we reserve the ID, this protects against simultaneous requests
        $url = $this->urlRepository->create([
            'url' => $url,
        ]);

        $url->short_path = $this->shortener->generateShortPath($url->id);

        $url = $this->urlRepository->update($url->id, $url->toArray());

        return $url;
    }

    public function logVisit(string $shortPath): Url
    {
        $url = $this->urlRepository->findOneBy([
            'short_path' => $shortPath
        ]);

        return $this->urlRepository->update($url->id, [
            'visits' => $url->visits + 1
        ]);
    }

    public function getRedirectPath(string $shortPath): string
    {
        $url = $this->urlRepository->findOneBy([
            'short_path' => $shortPath
        ]);

        return $url->url;
    }

    public function getMostVisitedUrls(int $limit = 10): Collection
    {
        return $this->urlRepository->getMostVisitedUrls($limit);
    }
}
