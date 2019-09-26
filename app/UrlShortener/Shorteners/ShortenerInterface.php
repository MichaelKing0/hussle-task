<?php

namespace App\UrlShortener\Shorteners;

interface ShortenerInterface
{
    public function generateShortPath($id): string;
}
