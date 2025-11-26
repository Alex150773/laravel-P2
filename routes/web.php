<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', [CategoriaController::class, 'index']);

Route::resource('categorias', CategoriaController::class);
