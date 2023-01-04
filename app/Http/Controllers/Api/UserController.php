<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    // 
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        $id = auth()->user()->id;
        return $this->userRepository->getById($id);
    }

}
