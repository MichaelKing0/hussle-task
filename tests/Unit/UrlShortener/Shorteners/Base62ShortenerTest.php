<?php

namespace Tests\Unit\UrlShortener\Shorteners;

use App\UrlShortener\Shorteners\Base62Shortener;
use Tests\TestCase;

class Base62ShortenerTest extends TestCase
{
    /** @var Base62Shortener */
    private $base62Shortener;

    public function setUp(): void
    {
        parent::setUp();
        $this->base62Shortener = app(Base62Shortener::class);
    }

    /**
     * @dataProvider getTestShortenData
     */
    public function testShorten($expectedResult, $input)
    {
        $this->assertEquals($expectedResult, $this->base62Shortener->generateShortPath($input));
    }

    public function getTestShortenData()
    {
        return [
            ['1', 1],
            ['2', 2],
            ['3D', 199],
        ];
    }
}
