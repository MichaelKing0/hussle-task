<?php

namespace Tests\Unit\UrlShortener\Services;

use App\UrlShortener\Repositories\UrlRepository;
use App\UrlShortener\Services\UrlShortenerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlShortenerServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @var UrlShortenerService */
    private $urlShortenerService;

    public function setUp(): void
    {
        parent::setUp();
        $this->urlShortenerService = app(UrlShortenerService::class);
    }

    public function testShorten()
    {
        $url = 'https://www.google.com';

        $result = $this->urlShortenerService->shorten($url);

        $this->assertEquals([
            'id' => 1,
            'url' => $url,
            'short_path' => '1',
            'visits' => 0,
        ], $result->only(['id', 'url', 'short_path', 'visits']));

        return $result;
    }

    public function testLogVisit()
    {
        /** @var UrlRepository $urlRepository */
        $urlRepository = app(UrlRepository::class);
        $urlRepository->create(['url' => 'https://www.google.com', 'short_path' => '1', 'visits' => 0]);

        $url = $this->urlShortenerService->logVisit('1');
        $this->assertEquals(1, $url->visits);
    }

    public function testGetRedirectPath()
    {
        /** @var UrlRepository $urlRepository */
        $urlRepository = app(UrlRepository::class);
        $urlRepository->create(['url' => 'https://www.google.com', 'short_path' => '1', 'visits' => 0]);

        $url = $this->urlShortenerService->getRedirectPath('1');
        $this->assertEquals('https://www.google.com', $url);
    }

    public function testGetMostVisitedUrls()
    {
        /** @var UrlRepository $urlRepository */
        $urlRepository = app(UrlRepository::class);
        $urlRepository->create(['url' => 'https://www.google.com', 'short_path' => '1', 'visits' => 0]);
        $urlRepository->create(['url' => 'https://www.google.com/test', 'short_path' => '2', 'visits' => 1]);

        $urls = $this->urlShortenerService->getMostVisitedUrls();
        $this->assertEquals(['url' => 'https://www.google.com/test', 'visits' => 1], $urls[0]->only('url', 'visits'));
        $this->assertEquals(['url' => 'https://www.google.com', 'visits' => 0], $urls[1]->only('url', 'visits'));
    }
}
