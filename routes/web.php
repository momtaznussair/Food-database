<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DietController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ToxinController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (App::environment('production')) {
    URL::forceScheme('https');
}
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

Route::get('/', [HomeController::class, 'index'])->name('/');

// diets
// Route::resource('diets', DietController::class);

// toxins
// Route::resource('toxins', ToxinController::class);

// food
Route::resource('foods', FoodController::class);
Route::post('filter', [HomeController::class, 'filter'])->name('filter');
// Route::post('import', [FoodController::class, 'import'])->name('import');

// pages
Route::get('/{page}', [AdminController::class, "index"]);
