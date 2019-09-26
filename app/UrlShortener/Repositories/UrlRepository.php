<?php

namespace App\UrlShortener\Repositories;

use App\Url;
use Illuminate\Support\Collection;

class UrlRepository extends EloquentRepository
{
    public function __construct(Url $url)
    {
        parent::__construct($url);
    }

    public function getMostVisitedUrls(int $limit): Collection
    {
        return $this->model->newQuery()
            ->orderBy('visits', 'desc')
            ->limit($limit)
            ->get();
    }
}
