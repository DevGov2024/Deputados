<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadoController;





Route::get('/', [DeputadoController::class, 'index'])->name('deputados.index');