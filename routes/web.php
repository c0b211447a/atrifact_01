<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClothController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PatternsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('toppage');
});

Route::get('/cloths/items', function () {
    return view('cloths.items');
})->middleware(['auth', 'verified'])->name('items');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::prefix('/cloths')->group(function(){
        Route::controller(ClothController::class)->group(function(){
            Route::get('items', 'showItems')->name('showItems');
            Route::post('items', 'store_item')->name('store_item');
            Route::get('items/add_items', 'add_item')->name('add_item');
            Route::delete('items/{item_id}', 'delete_item')->name('delete_item');
            Route::post('items/{item_id}', 'update_item')->name('update_item');
            Route::get('items/{item_id}/edit', 'edit_item')->name('edit_item');
        });
        
        Route::controller(ColorController::class)->group(function(){
            Route::get('colors/{select_color}', 'showColors')->name('showSelectColors');
        });
        
        Route::controller(CategoryController::class)->group(function(){
            Route::get('categories/{select_category}', 'showCategories')->name('showSelectCategories');
        });
        
        Route::controller(PatternsController::class)->group(function(){
            Route::get('patterns', 'showPatterns')->name('showPatterns');
            Route::get('patterns/item/{item_id}', 'showItemInPatterns')->name('showItemInPatterns');
            Route::delete('patterns/delete_patterns/{patterns_id}', 'delete_patterns')->name('delete_patterns');
            Route::get('patterns/edit_patterns/{patterns_id}', 'edit_patterns')->name('edit_patterns');
            Route::put('patterns/update_patterns', 'update_patterns')->name('update_patterns');
            Route::get('patterns/add_patterns', 'add_pattern')->name('add_pattern');
            Route::post('patterns/add_patterns/store', 'store_pattern')->name('store_pattern');
        });
    });
});

require __DIR__.'/auth.php';
