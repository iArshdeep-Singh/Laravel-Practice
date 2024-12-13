<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HumanCotroller;


Route::get("/", function () {
    return view("welcome");
});



Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/x', function () {
    return view('x');
})->name('x');



Route::get('human/create', [HumanCotroller::class, 'create'])->name('human.create');
Route::post('human/store', [HumanCotroller::class, 'store'])->name('human.store');
Route::get('human/index', [HumanCotroller::class, 'index'])->name('human.index');

Route::get("/test", [Test::class, 'test']);

