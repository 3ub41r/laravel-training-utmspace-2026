<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\StatusPelajarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/mssql', function () {
    try {
        DB::connection('sqlsrv')->getPdo();
        return "MSSQL Connection OK!";
    } catch (\Exception $e) {
        return "Connection FAILED: " . $e->getMessage();
    }
});




Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/get-semesters', [IntakeController::class, 'getSemesters']);
    Route::get('/home', [IntakeController::class, 'tinjauanAkademik'])->name('tinjauan-akademik');
    Route::get('/kemasukan-pelajar', [IntakeController::class, 'kemasukanPelajar'])->name('kemasukan-pelajar');
    
    Route::get('/status-pelajar', [StatusPelajarController::class, 'index'])
        ->name('status-pelajar');
    
    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');
});
