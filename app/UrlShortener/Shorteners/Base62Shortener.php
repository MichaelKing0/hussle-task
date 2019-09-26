<?php

namespace App\UrlShortener\Shorteners;

use Tuupola\Base62Proxy as Base62;

class Base62Shortener implements ShortenerInterface
{
    public function generateShortPath($id): string
    {
        return Base62::encodeInteger($id);
    }
}
