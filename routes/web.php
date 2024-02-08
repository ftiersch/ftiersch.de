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

Route::get('/', function (\Illuminate\Http\Request $request) {
    return redirect($request->getPreferredLanguage(config('app.available_locales')));
});

Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(\App\Http\Middleware\SetLocale::class)
    ->group(function() {

    Route::get('/', \App\Http\Controllers\PageController::class)->name('home');

});

Route::get('/old', function () {
    return view('index');
});
