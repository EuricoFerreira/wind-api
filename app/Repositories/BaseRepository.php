<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface {

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;   
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function delete(int $id): bool
    {
        $model = $this->getById($id);
        return $model->delete();
    }

    public function update(int $id, array $attributes): Model
    {   
        $model = $this->getById($id);
        $model->update($attributes);
        return $model;
    }

    public function getAllData( array $relations)
    {
        return $this->model->with($relations)->get();
    }
}