<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubmissionController;

Route::get('/stores', [StoreController::class, 'index']);
Route::get('/products', [ProductController::class, 'all']);
Route::get('/stores/{store}/products', [ProductController::class, 'index']);
Route::get('/submissions', [SubmissionController::class, 'index']);
Route::post('/submissions', [SubmissionController::class, 'store']);