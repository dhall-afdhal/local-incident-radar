<?php

use App\Http\Controllers\IncidentController;
use Illuminate\Support\Facades\Route;

Route::get('/incidents-map', [IncidentController::class, 'apiMap'])->name('api.incidents-map');


