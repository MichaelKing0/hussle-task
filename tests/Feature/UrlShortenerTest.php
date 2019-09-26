<?php

namespace Tests\Feature;

use App\UrlShortener\Services\UrlShortenerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    use RefreshDatabase;

    public function testHomepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testUrlCreate()
    {
        $response = $this->get('/urls/create');
        $response->assertStatus(200);
    }

    public function testUrlPost()
    {
        $this->withoutMiddleware();

        $response = $this->post('/urls', [
            'url' => 'https://www.google.com'
        ]);

        $response->assertOk();
        $response->assertSeeText('Success!');
    }

    public function testShortPathRedirects()
    {
        /** @var UrlShortenerService $urlShortenerService */
        $urlShortenerService = app(UrlShortenerService::class);
        $url = $urlShortenerService->shorten('https://www.google.com');

        $response = $this->get('/r/' . $url->short_path);
        $this->assertTrue($response->isRedirect('https://www.google.com'));
    }
}
