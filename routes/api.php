<?php

use App\Http\Controllers\Api\AgamaController;
use App\Http\Controllers\Api\JenisPegawaiController;
use App\Http\Controllers\Api\StatusPegawaiController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\SubunitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('jenis-pegawais', JenisPegawaiController::class);
Route::apiResource('status-pegawais', StatusPegawaiController::class);
Route::apiResource('agamas', AgamaController::class);
Route::apiResource('units', UnitController::class);
Route::apiResource('subunits', SubunitController::class);

Route::get('/test', function () {
    return response()->json(['message' => 'Biso nampil coy']);
});
