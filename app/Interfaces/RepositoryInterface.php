<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {

    public function getAllData(array $relacions);
    public function getById(int $id);
    public function create(array $attributes): Model;
    public function update(int  $int, array $attributes): Model;
    public function delete(int $int);
}