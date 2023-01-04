<?php

namespace App\Interfaces;

use App\Interfaces\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {

   public function getProfile(int $user_id);
   public function getTeams(int $user_id);

}