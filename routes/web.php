<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserProfileController;



Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/home', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('pages/order', [OrderController::class, 'index'])->name('order');
Route::post('pages/order', [OrderController::class, 'store'])->name('store.order');



Route::group(['middleware' => 'auth'], function () {

	Route::get('/pages/history', [HistoryController::class, 'index'])->name('history');
	Route::get('pages/order', [OrderController::class, 'index'])->name('order');


	Route::group(['middleware' => 'cekLevel:admin'], function () {

		// history
		Route::post('/pages/history/bulan', [HistoryController::class, 'historyBulan'])->name('history.bulan');
		Route::post('/pages/history/barang', [HistoryController::class, 'historyBarang'])->name('history.barang');
		Route::get('/pages/history/exportAll', [HistoryController::class, 'exportAll'])->name('history.exportAll');
		Route::post('/pages/history/exportBulan', [HistoryController::class, 'exportBulan'])->name('history.exportBulan');
		Route::post('/pages/history/exportBarang', [HistoryController::class, 'exportBarang'])->name('history.exportBarang');

		Route::post('pages/order', [OrderController::class, 'store'])->name('store.order');

		Route::get('/coba', function () {
			return 'ini buat admin';
		});
		// master user
		Route::resource('/master/user', MasterUserController::class);
		Route::get('/master/user/{user:id}/nonaktif', [MasterUserController::class, 'nonaktif'])->name('user.nonaktif');
		Route::get('/master/user/{user:id}/aktif', [MasterUserController::class, 'aktif'])->name('user.aktif');

		Route::post('master/barang', [BarangController::class, 'store'])->name('store.barang');
		Route::get('master/barang', [BarangController::class, 'index'])->name('barang');

		Route::put('master/barang/{barang:id}/update', [BarangController::class, 'update'])->name('update.barang');
		Route::put('master/barang/{barang:id}/aktif', [BarangController::class, 'aktif'])->name('aktif.barang');
		Route::put('master/barang/{barang:id}/nonaktif', [BarangController::class, 'nonaktif'])->name('nonaktif.barang');
	});

	Route::group(['middleware' => 'cekLevel:teknisi'], function () {
		Route::get('/coba2', function () {
			return 'ini buat teknisi';
		});
		Route::put('pages/order/{order:id}/update', [OrderController::class, 'update'])->name('update.order');
	});



	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::post('logcek', function () {
		return auth()->user();
	})->name('logcek');
});
