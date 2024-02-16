<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\RegisterController;
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
    return view('login');
})->name('login');
Route::get('/test/pdf', function () {
    return view('pdf_sertif');
});

Route::post('/login',[RegisterController::class,'Login']);

Route::get('/register',[RegisterController::class,'index']);
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/auth/google/callback',[RegisterController::class,'Login_G']);

Route::group(['middleware' => ['auth', 'role:EO']], function () {
    Route::get('/dashboard', function () {
        return view('eo.dashboard');
    })->name('home');
    Route::get('/paket', function () {
        return view('eo.paket');
    })->name('paket');
    Route::get('/invoice', function () {
        return view('eo.invoice');
    })->name('invoice');
    Route::get('/event', function () {
        return view('eo.event');
    })->name('event');
    Route::get('/profile', function () {
        return view('eo.profile');
    })->name('profile');
    Route::get('/create/free', function () {
        return view('eo.newFreeEvent');
    })->name('create');
    Route::get('/create/premium', function () {
        return view('eo.newEvent');
    })->name('create_premium');
    Route::get('/event/detail/{id}', function () {
        return view('eo.DetailEvent');
    })->name('Detail');
    Route::get('/event/detail/{id}/operator', function () {
        return view('eo.form_operator');
    })->name('DetailOp');
    Route::get('/event/detail/{id}/sertifikat', function () {
        return view('eo.manage_sertifikat');
    })->name('DetailSertif');
    Route::get('/event/detail/{id}/tamu', function () {
        return view('eo.form_tamu');
    })->name('DetailTamu');
    Route::get('/event/detail/{id}/operator/{id_operator}', function () {
        return view('eo.form_edit_operator');
    })->name('DetailProfOp');
    Route::get('/event/detail/{id}/tamu/{id_tamu}', function () {
        return view('eo.form_edit_tamu');
    });
});
    Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/admin/paket', function () {
        return view('admin.paket');
    });
    Route::get('/fitur-paket', function () {
        return view('admin.fiturpaket');
    });
    Route::get('/create-paket', function () {
        return view('admin.create_paket');
    });
    Route::get('/create-fitur-paket', function () {
        return view('admin.create_fiturpaket');
    });
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    Route::get('/paket/edit/{id}', function () {
        return view('admin.edit_paket');
    });
    Route::get('/fitur-paket/edit/{id}', function () {
        return view('admin.edit_fiturpaket');
    });
    Route::get('/admin/eo', function () {
        return view('admin.eo');
    });
    Route::get('/create-eo', function () {
        return view('admin.eo_add');
    });
    Route::get('/admin/event', function () {
        return view('admin.event');
    });
    Route::get('/kategori-event', function () {
        return view('admin.kategori_event');
    });
    Route::get('/create-kategori', function () {
        return view('admin.create_kategori');
    });
    Route::get('/event/kategori/edit/{id}', function () {
        return view('admin.edit_kategori');
    });
    Route::get('/admin/transaksi', function () {
        return view('admin.transaksi');
    });
});
    Route::get('/logout',function(){
        Auth::Logout();
        return redirect('/');
    });



 