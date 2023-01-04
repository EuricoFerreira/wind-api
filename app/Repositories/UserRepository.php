<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
    
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getProfile(int $user_id): Collection {
        return $this->model->getByid($user_id);
    }
    
    public function getTeams(int $user_id): Collection {
        return $this->model->getById($user_id)->teams;
    }

}