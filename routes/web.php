<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Grafik;
use App\Http\Controllers\Report;
use App\Http\Controllers\Helpdesk;
use App\Http\Controllers\Chat;
use App\Http\Controllers\Dom;

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

Route::get('helpdesk', [Helpdesk::class, 'index'])->name('helpdesk');
Route::post('addtickets', [Helpdesk::class, 'addticket'])->name('helpdesk');
Route::get('showtickets', [Helpdesk::class, 'showtickets'])->name('helpdesk');

Route::get('chat/{idconv}/{user}', [Chat::class, 'index'])->name('chat');
Route::post('addchat', [Chat::class, 'addchat'])->name('addchat');
Route::post('getchat', [Chat::class, 'getchat'])->name('getchat');

Route::get('dom', [Dom::class, 'index'])->name('dom');
Route::post('postdom', [Dom::class, 'postdata'])->name('postdom');
Route::get('struk', [Dom::class, 'struk'])->name('struk');
