<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cloths.index');
});

Route::get('/cloths', [ClothController::class, 'index']);
Route::get('/cloths/colors', [ClothController::class, 'showColors']);
Route::get('/cloths/items', [ClothController::class, 'showItems']);
Route::post('/cloths/items', [ClothController::class, 'store_items']);
Route::get('/cloths/items/add_items', [ClothController::class, 'add_items']);
Route::get('/cloths/patterns', [ClothController::class, 'showPatterns']);