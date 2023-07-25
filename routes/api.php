<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'create'])->middleware('can:create posts','auth:api');
Route::post('/token', [UserController::class, 'login']);
//Route::post('/users', [UserController::class, 'create']);


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'create'])->middleware('can:create posts','auth:api');



Route::middleware([ 'can:create posts'])->group(function () {
    // Create a new post
    Route::post('/posts', function (Request $request) {
        $request->user()->token();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
       

        return ($user);      });
});
