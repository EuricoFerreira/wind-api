<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ApiResponseTrait;

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     * path="/api/register",
     * summary="Register",
     * description="register by name, email, password",
     * operationId="authRegister",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="name", type="string", format="string", example="john"),
     *       @OA\Property(property="email", type="string", format="email", example="teste@teste.com"),
     *       @OA\Property(property="password", type="string", format="password", example="secret123"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="User Registered Successfully",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User Registered Successfully")
     *        )
     *     )
     * )
     * 
     */

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        
        $user = $this->userRepository->create($data);
        
        return $this->successResponse("User Registered Successfully");
    }

    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="teste@teste.com"),
     *       @OA\Property(property="password", type="string", format="password", example="secret123"),
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Wrong email or password.")
     *        )
     *     )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="User Registered Successfully",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User Registered Successfully")
     *        )
     *     )
     * )
     * 
     */
    public function login(LoginRequest $request)
    {   
        if(!auth()->attempt($request->all())) 
            return $this->unAuthorizedResponse("Wrong email or password.");
        
        $token = auth()->user()->createToken('authToken')->plainTextToken;
        
        return $this->successResponse([
            "token" => $token,
            "user" => auth()->user()
        ]);
    }
}
