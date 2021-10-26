<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\MemberController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/members', [MemberController::class, 'get_members']);
Route::post('/create_member', [MemberController::class, 'create_member']);
Route::put('/edit_member/{id}', [MemberController::class, 'edit_member']);
Route::delete('/delete_member/{id}', [MemberController::class, 'delete_member']);