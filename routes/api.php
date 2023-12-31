<?php

use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('pengaduan',[PengaduanController::class, 'store']);

Route::get('masyarakat',[MasyarakatController::class, 'index']);
Route::post('register',[MasyarakatController::class, 'register']);
Route::post('login',[MasyarakatController::class, 'login']);
Route::post('logout',[MasyarakatController::class, 'logout'])->middleware('auth:sanctum');

Route::get('image/{id}',[PengaduanController::class, 'sendImage']);
Route::get('pengaduan',[PengaduanController::class, 'index']);
Route::get('pengaduan/{nik}',[PengaduanController::class, 'getByNik']);
Route::post('pengaduan',[PengaduanController::class, 'store']);
Route::put('pengaduan/edit/{id}',[PengaduanController::class, 'update']);
Route::delete('pengaduan/delete/{id}',[PengaduanController::class, 'destroy']);

Route::get('tanggapan/{nik}',[TanggapanController::class, 'getByNik']);
