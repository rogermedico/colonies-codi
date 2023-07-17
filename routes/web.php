<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ViewController::class, 'index'])
    ->name('index');

Route::post('code/validate', [CodeController::class, 'validateCode'])
    ->name('code.validate');

Route::get('reset', [CodeController::class, 'reset'])
    ->name('reset');

Route::get('solucions', [CodeController::class, 'showCodes'])
    ->name('folder.show');

Route::post('folder/{folder}/add-try', [CodeController::class, 'addTry'])
    ->name('folder.addTry');

Route::post('folder/{folder}/remove-try', [CodeController::class, 'removeTry'])
    ->name('folder.removeTry');
