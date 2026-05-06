<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/posts", [PostController::class, "index"])->middleware('auth:sanctum');
Route::get("/posts/{id}", [PostController::class, "show"])->middleware('auth:sanctum');
Route::post("/posts", [PostController::class, "store"])->middleware('auth:sanctum');
Route::post("/posts/{id}", [PostController::class, "update"])->middleware('auth:sanctum');
Route::delete("/posts/{id}", [PostController::class, "destroy"])->middleware('auth:sanctum');

Route::get("/users", [UserController::class, "index"])->middleware('auth:sanctum');
Route::get("/users/{id}", [UserController::class, "show"])->middleware('auth:sanctum');
Route::post("/users", [UserController::class, "store"])->middleware('auth:sanctum');
Route::post("/users/{id}", [UserController::class, "update"])->middleware('auth:sanctum');
Route:: delete("/users/{id}", [UserController::class, "destroy"])->middleware('auth:sanctum');

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});