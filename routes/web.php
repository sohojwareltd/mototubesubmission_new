<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PageController::class,'index'])->name('home');
Route::get('submit',[PageController::class,'submit'])->name('submit.page');
Route::get('thankyou',[PageController::class,'thankyou'])->name('thankyou');
Route::post('submit',[PageController::class,'store'])->name('submit.post');
Route::post('video-upload', [PageController::class, 'progressbar'])->name('progressbar');

Route::get('validate-email', [PageController::class, 'validateEmail'])->name('validate.email');
