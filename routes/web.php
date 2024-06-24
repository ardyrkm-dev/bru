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
use App\Http\Controllers\DashboardCriteriaComparisonController;
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

  Route::get('dashboard/profile', [DashboardProfileController::class, 'index']);
  Route::put('dashboard/profile/{user}', [DashboardProfileController::class, 'update']);

  Route::get('dashboard/criteria-comparisons', [DashboardCriteriaComparisonController::class, 'index']);
  Route::post('dashboard/criteria-comparisons', [DashboardCriteriaComparisonController::class, 'store']);

  Route::get('dashboard/criteria-comparisons/{criteria_analysis}', [DashboardCriteriaComparisonController::class, 'show']);

  Route::put('dashboard/criteria-comparisons/{criteria_analysis}', [DashboardCriteriaComparisonController::class, 'updateValue']);

  Route::delete('dashboard/criteria-comparisons/{criteria_analysis}', [DashboardCriteriaComparisonController::class, 'destroy']);

  Route::get('dashboard/criteria-comparisons/result/{criteria_analysis}', [DashboardCriteriaComparisonController::class, 'result']);

  Route::get('dashboard/final-ranking', [DashboardRankController::class, 'index']);
  Route::get('dashboard/final-ranking/{criteria_analysis}', [DashboardRankController::class, 'show']);

  Route::resources([

    'dashboard/criterias'       => AdminCriteriaController::class,
    'dashboard/users'           => AdminUserController::class,
    'dashboard/alternatives'    => AdminAlternativeController::class
  ], ['except' => 'show']);

  Route::get('dashboard/aktifitas', [AdminAktifitasController::class, 'index'])->name('aktifitas');
  Route::get('dashboard/aktifitas/create', [AdminAktifitasController::class, 'create'])->name('aktifitas.form');
  Route::post('dashboard/aktifitas/createP', [AdminAktifitasController::class, 'store'])->name('aktifitas.tambah');
  Route::get('dashboard/aktifitas/{aktifitas}/edit', [AdminAktifitasController::class, 'edit'])->name('aktifitas.form.edit');
  Route::put('dashboard/aktifitas/update/{aktifitas}', [AdminAktifitasController::class, 'update'])->name('aktifitas.update');
  Route::delete('dashboard/aktifitas/destroy/{aktifitas}', [AdminAktifitasController::class, 'destroy'])->name('aktifitas.delete');
  // Route::put('dashboard/aktifitas/update/{aktifitas}', [AdminAktifitasController::class, 'update'])->name('aktifitas.update');
  // Route::delete('dashboard/aktifitas/delete/{aktifitas}', [AdminAktifitasController::class, 'destroy'])->name('aktifitas.destroy');

  // Route::put('dashboard/criterias/update/{criteria}', [AdminCriteriaController::class, 'update'])->name('criterias.update');
  // Route::delete('dashboard/criterias/delete/{criteria}', [AdminCriteriaController::class, 'destroy'])->name('criterias.destroy');

  // Route::put('dashboard/users/update/{user}', [AdminUserController::class, 'update'])->name('users.update');
  // Route::delete('dashboard/users/delete/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

  // Route::put('dashboard/alternatives/update/{alternative}', [AdminAlternativeController::class, 'update'])->name('alternatives.update');
  // Route::delete('dashboard/alternatives/delete/{alternative}', [AdminAlternativeController::class, 'destroy'])->name('alternatives.destroy');
});
