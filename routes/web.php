<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('item', ItemController::class);

// The fully qualified name space is necessary only in laravel 8 because it's a known bug
Route::get('/item/tick/{id}', [App\Http\Controllers\ItemController::class, 'tick'])->name('tick');

Route::get('/item/pricelimit/{id}', [App\Http\Controllers\ItemController::class, 'setPrice'])->name('item.pricelimit');
