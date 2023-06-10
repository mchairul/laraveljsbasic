<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Grafik;
use App\Http\Controllers\Report;

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


Route::get('grafik', [Grafik::class, 'index'])->name('grafik');

Route::get('report', [Report::class, 'index'])->name('report');