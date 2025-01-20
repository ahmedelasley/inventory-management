<?php

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

Route::get('/', function () { return view('welcome'); });
Route::get('/blank', function () { return view('admin.pages.blank.index'); });


require __DIR__.'/user.php';


require __DIR__.'/admin.php';
require __DIR__.'/supervisor.php';
require __DIR__.'/keeper.php';
