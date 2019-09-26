<?php

namespace App\UrlShortener\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $fields): Model
    {
        $model = $this->model->newInstance($fields);
        $model->save();

        return $model;
    }

    public function update(int $id, array $fields): Model
    {
        $model = $this->model->findOrFail($id);
        $model->fill($fields);
        $model->save();

        return $model;
    }

    public function findOneBy(array $keyValues): Model
    {
        return $this->model->where($keyValues)->first();
    }
}
