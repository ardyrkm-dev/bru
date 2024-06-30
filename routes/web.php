<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LandingPagesController;
use App\Http\Controllers\AdminCriteriaController;
use App\Http\Controllers\DashboardRankController;
use App\Http\Controllers\AdminAlternativeController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\AdminAktifitasController;
use App\Http\Controllers\AktifitasController;
use App\Http\Controllers\AlternatifCon;
use App\Http\Controllers\DashboardCriteriaComparisonController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerbandinganC;
use App\Http\Controllers\ProfilC;
use App\Http\Controllers\RankC;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [LandingPagesController::class, 'index'])->name('home');
Route::get('/aktifitasPage', [LandingPagesController::class, 'aktifitasPage'])->name('aktifitasPage');
Route::get('/aktifitasPage/{id}/detail', [LandingPagesController::class, 'detailAktifitasPage'])->name('detailAktifitas');


Auth::routes(['verify' => true]);
Route::get('password/forgot', [AuthController::class, 'showLinkRequestForm'])->name('password.halaman');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');

Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');
Route::get('/email/verify', function () {
  return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'index'])->name('login');
  Route::post('/login', [AuthController::class, 'authenticate']);
  Route::get('/signup', [AuthController::class, 'signUp'])->name('signUp');
  Route::post('/signup', [AuthController::class, 'store']);
});



Route::middleware(['auth', 'verified'])->group(function () {
  Route::post('/signout', [AuthController::class, 'signOut'])->name('signout');

  Route::get('/dashboard', function () {

    return view('pages.dashboard.index', [
      'title' => 'Dashboard'
    ]);
  });

  Route::get('dashboard/profile', [ProfilC::class, 'index']);
  Route::put('dashboard/profile/{user}', [ProfilC::class, 'update']);

  Route::get('dashboard/kriteriaPerbandingan', [PerbandinganC::class, 'index']);
  Route::post('dashboard/kriteriaPerbandingan', [PerbandinganC::class, 'store']);

  Route::get('dashboard/kriteriaPerbandingan/{criteria_analysis}', [PerbandinganC::class, 'show']);

  Route::put('dashboard/kriteriaPerbandingan/{criteria_analysis}', [PerbandinganC::class, 'updateValue']);

  Route::delete('dashboard/kriteriaPerbandingan/{criteria_analysis}', [PerbandinganC::class, 'destroy']);

  Route::get('dashboard/kriteriaPerbandingan/result/{criteria_analysis}', [PerbandinganC::class, 'result']);

  Route::get('dashboard/matrikAlternatif', [RankC::class, 'index']);
  Route::get('dashboard/matrikAlternatif/{criteria_analysis}', [RankC::class, 'show']);

  Route::resources([

    'dashboard/criterias'       => KriteriaController::class,
    'dashboard/users'           => UserController::class,
    'dashboard/alternatives'    => AlternatifCon::class
  ], ['except' => 'show']);

  Route::get('dashboard/aktifitas', [AktifitasController::class, 'index'])->name('aktifitas');
  Route::get('dashboard/aktifitas/create', [AktifitasController::class, 'create'])->name('aktifitas.form');
  Route::post('dashboard/aktifitas/createP', [AktifitasController::class, 'store'])->name('aktifitas.tambah');
  Route::get('dashboard/aktifitas/{aktifitas}/edit', [AktifitasController::class, 'edit'])->name('aktifitas.form.edit');
  Route::put('dashboard/aktifitas/update/{aktifitas}', [AktifitasController::class, 'update'])->name('aktifitas.update');
  Route::delete('dashboard/aktifitas/destroy/{aktifitas}', [AktifitasController::class, 'destroy'])->name('aktifitas.delete');
});
