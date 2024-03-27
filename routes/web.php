<?php

use App\Livewire\CategoryIndex;
use App\Livewire\Counter;
use App\Livewire\PostIndex;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/posts', PostIndex::class)->name('posts');
    Route::get('/categories', CategoryIndex::class)->name('categories');
});

Route::get('/test', Counter::class);

Route::get('/ver', function () {
    $dados = \App\Models\Post::all();
    dd($dados->toArray());
    //return view('welcome');
});