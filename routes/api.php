<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/register", [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/profile", [UserController::class, 'profile']);

    Route::get("/teams", [TeamController::class, 'allTeams']);
    Route::post("/teams", [TeamController::class, 'create']);
    Route::put("/teams/{id}", [TeamController::class, 'update']);
    Route::get("/teams/{id}/members", [TeamController::class, 'getTeamMembers']);
    Route::post("teams/add-member", [TeamController::class, 'addMember']);
    Route::post("teams/remove-member", [TeamController::class, 'removeMember']);
});