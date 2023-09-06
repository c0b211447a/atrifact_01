<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothController;
use App\Http\Controllers\CategoryController;

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
Route::get('/cloths/categories/{select_category}', [CategoryController::class, 'showCategories']);
Route::get('/cloths/colors', [ClothController::class, 'showColors']);
Route::get('/cloths/items', [ClothController::class, 'showItems']);
Route::post('/cloths/items', [ClothController::class, 'store_item']);
Route::get('/cloths/items/add_items', [ClothController::class, 'add_item']);
Route::delete('/cloths/items/{item_id}', [ClothController::class, 'delete_item']);
Route::get('/cloths/patterns', [ClothController::class, 'showPatterns']);