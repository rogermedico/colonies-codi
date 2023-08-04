<?php

use App\Http\Controllers\ActivateFolderController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CountdownController;
use App\Http\Controllers\SolveCodeController;
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

Route::get('/solucions', [ViewController::class, 'solutions'])
    ->name('solutions');

Route::get('reset', [CodeController::class, 'reset'])
    ->name('reset');

Route::get('admin', [CodeController::class, 'showCodes'])
    ->name('folder.show');

Route::post('folder/{folder}/add-try', [CodeController::class, 'addTry'])
    ->name('folder.addTry');

Route::post('folder/{folder}/remove-try', [CodeController::class, 'removeTry'])
    ->name('folder.removeTry');

Route::get('folder/{folder}/activate', ActivateFolderController::class)
    ->name('folder.activate.toggle');

Route::get('code/{code}/solve-toggle', SolveCodeController::class)
    ->name('code.solve.toggle');

Route::get('countdown/reset', [CountdownController::class, 'reset'])
    ->name('countdown.reset');

Route::get('countdown/reset/minute', [CountdownController::class, 'setToOneMinute'])
    ->name('countdown.reset.minute');

Route::get('countdown/{minutes}/add', [CountdownController::class, 'addMinutes'])
    ->name('countdown.minutes.add');

Route::get('countdown/{minutes}/subtract', [CountdownController::class, 'subtractMinutes'])
    ->name('countdown.minutes.subtract');
