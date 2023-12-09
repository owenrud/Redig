<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ResetPwdController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create-account',[RegisterController::class,'Register']);
Route::post('/register-account',[RegisterController::class,'Register_API']);
Route::post('/user/login',[RegisterController::class,'Login_API']);

Route::prefix('fitur-paket')->group(function () {
    Route::get('/all', [PaketController::class, 'all_fitur']);
    Route::post('/show', [PaketController::class, 'show_fitur']);
    Route::post('/save', [PaketController::class, 'store_fitur']);
    Route::post('/update', [PaketController::class, 'update_fitur']);
    Route::delete('/delete/{id}', [PaketController::class, 'delete_fitur']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('paket')->group(function () {
    Route::get('/all', [PaketController::class, 'all']);
    Route::post('/show', [PaketController::class, 'show']);
    Route::post('/save', [PaketController::class, 'store']);
    Route::post('/update', [PaketController::class, 'update']);
    Route::delete('/delete/{id}', [PaketController::class, 'delete']);
    
    Route::prefix('payment')->group(function () {
    Route::post('/generate',[PaymentController::class, 'handlePayment']);
    });

    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('event')->group(function () {
    Route::get('/all', [EventController::class, 'all']);
    Route::post('/show', [EventController::class, 'show']);
    Route::post('/show/eo', [EventController::class, 'showEO']);
    Route::post('/save', [EventController::class, 'store']);
    Route::post('/update', [EventController::class, 'update']);
    Route::delete('/delete/{id}', [EventController::class, 'delete']);
    
    Route::prefix('kategori')->group(function () {

    Route::get('/all', [EventController::class, 'all_kategori']);
    Route::post('/show', [EventController::class, 'show_kategori']);
    Route::post('/save', [EventController::class, 'store_kategori']);
    Route::post('/update', [EventController::class, 'update_kategori']);
    Route::delete('/delete/{id}', [EventController::class, 'delete_kategori']);
    });
    Route::prefix('detail')->group(function () {
    Route::get('/all', [EventController::class, 'all_detail']);
    Route::post('/show', [EventController::class, 'show_detail']);
    Route::post('/save', [EventController::class, 'store_detail']);
    Route::post('/update', [EventController::class, 'update_detail']);
    Route::delete('/delete/{id}', [EventController::class, 'delete_detail']);
    });
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('provinsi')->group(function () {
    Route::get('/all', [ProvinsiController::class, 'all']);
    Route::post('/show', [ProvinsiController::class, 'show']);
    Route::post('/save', [ProvinsiController::class, 'store']);
    Route::post('/update', [ProvinsiController::class, 'update']);
    Route::delete('/delete/{id}', [ProvinsiController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});

Route::prefix('kabupaten')->group(function () {
    Route::get('/all', [KabupatenController::class, 'all']);
    Route::post('/show', [KabupatenController::class, 'show']);
    Route::post('/show/id', [KabupatenController::class, 'show_id']);
    
    Route::post('/save', [KabupatenController::class, 'store']);
    Route::post('/update', [KabupatenController::class, 'update']);
    Route::delete('/delete/{id}', [KabupatenController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});

Route::prefix('profile')->group(function () {
    Route::get('/all', [ProfileController::class, 'all']);
    Route::post('/show', [ProfileController::class, 'show']);
    Route::post('/save', [ProfileController::class, 'store']);
    Route::post('/update', [ProfileController::class, 'update']);
    Route::delete('/delete/{id}', [ProfileController::class, 'delete']);
    Route::delete('/delete/user/{id}', [ProfileController::class, 'delete_user']);
    
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('peserta')->group(function () {
    Route::get('/all', [PesertaController::class, 'all']);
    Route::post('/show', [PesertaController::class, 'show']);
    Route::post('/show/guest', [PesertaController::class, 'show_guest']);
    Route::post('/save', [PesertaController::class, 'store']);
    Route::post('/update', [PesertaController::class, 'update']);
    Route::delete('/delete/{id}', [PesertaController::class, 'delete']);
     // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});

Route::prefix('sertifikat')->group(function () {
    Route::get('/all', [SertifikatController::class, 'all']);
    Route::post('/show', [SertifikatController::class, 'show']);
    Route::post('/save', [SertifikatController::class, 'store']);
    Route::post('/update', [SertifikatController::class, 'update']);
    Route::delete('/delete/{id}', [SertifikatController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('operator')->group(function () {
    Route::get('/all', [OperatorController::class, 'all']);
    Route::post('/show', [OperatorController::class, 'show_event']);
    Route::post('/show/personal', [OperatorController::class, 'show_operator']);
    
    Route::post('/save', [OperatorController::class, 'store']);
    Route::post('/update', [OperatorController::class, 'update']);
    Route::delete('/delete/{id}', [OperatorController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});

Route::prefix('absen')->group(function () {
    Route::get('/all', [AbsenController::class, 'all']);
    Route::post('/show', [AbsenController::class, 'show']);
    Route::post('/save', [AbsenController::class, 'store']);
    Route::post('/update', [AbsenController::class, 'update']);
    Route::delete('/delete/{id}', [AbsenController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});

Route::prefix('invoice')->group(function () {
    Route::get('/all', [InvoiceController::class, 'all']);
    Route::post('/show', [InvoiceController::class, 'show']);
    Route::post('/show/user', [InvoiceController::class, 'show_user']);
    Route::post('/save', [InvoiceController::class, 'store']);
    Route::post('/update', [InvoiceController::class, 'update']);
    Route::delete('/delete/{id}', [InvoiceController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('verify')->group(function () {
    Route::get('/all', [VerificationController::class, 'all']);
    Route::post('/show', [VerificationController::class, 'show']);
    Route::post('/save', [VerificationController::class, 'store']);
    Route::post('/update', [VerificationController::class, 'update']);
    Route::delete('/delete/{id}', [VerificationController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});
Route::prefix('reset')->group(function () {
    Route::get('/all', [ResetPwdController::class, 'all']);
    Route::post('/save', [ResetPwdController::class, 'store']);
    Route::delete('/delete', [ResetPwdController::class, 'delete']);
    // Tambahkan rute lain di sini yang dimulai dengan '/fitur-paket'
});


