<?php

namespace App\Http\Controllers;

use App\UrlShortener\Services\UrlShortenerService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(UrlShortenerService $urlShortenerService)
    {
        return view('welcome', [
            'mostVisited' => $urlShortenerService->getMostVisitedUrls()
        ]);
    }
}
