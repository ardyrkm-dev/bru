<?php

namespace App\Http\Controllers;

use session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthSignInRequest;
use App\Http\Requests\Auth\AuthSignUpRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;


use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'FitSolusi || Register',
    ];

    return view('auth.signin', $data);
  }

  public function signUp()
  {
    $data = [
      'title' => 'FitSolusi || Login',
    ];

    return view('auth.signup', $data);
  }

  public function store(AuthSignUpRequest $request)
  {
    $validate = $request->validated();

    $validate['password'] = Hash::make($validate['password']);

    $user = User::create($validate);
    $user->sendEmailVerificationNotification();
    Log::info('Email verification notification sent to: ' . $user->email);
    return redirect('/email/verify')->with('success', 'Your account has been created! Please verify your email.');
  }

  public function authenticate(AuthSignInRequest $request)
  {
    $credentials = $request->validated();

    // autentikasi user
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('/dashboard');
    }

    // sign in gagal
    return back()->with('failed', "Sign in failed, please try again");
  }

  public function signOut(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'You have been logged out!');



    // Auth::logout();
    //     $request -> session()-> invalidate();
    //     $request -> session()-> regenerate();

    //     return redirect('/');
  }
  public function showLinkRequestForm()
  {
    return view('auth.passwords.email');
  }

  // Mengirim link reset password ke email pengguna
  public function sendResetLinkEmail(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
      return back()->with('status', __($status));
    }

    throw ValidationException::withMessages([
      'email' => [trans($status)],
    ]);
  }

  // Menampilkan form reset password
  public function showResetForm(Request $request, $token = null)
  {
    return view('auth.passwords.reset')->with(
      ['token' => $token, 'email' => $request->email]
    );
  }

  // Mengatur ulang password
  public function reset(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password),
        ])->save();

        $user->setRememberToken(Str::random(60));

        event(new PasswordReset($user));
      }
    );

    if ($status === Password::PASSWORD_RESET) {
      return redirect()->route('login')->with('status', __($status));
    }

    return back()->withErrors(['email' => [trans($status)]]);
  }
  public function redirectToFacebook()
  {
    return Socialite::driver('facebook')->redirect();
  }

  public function handleFacebookCallback()
  {
    try {
      $facebookUser = Socialite::driver('facebook')->user();
    } catch (\Exception $e) {
      return redirect('/login')->with('failed', 'Something went wrong or you denied the app.');
    }

    $existingUser = User::where('provider_id', $facebookUser->getId())
      ->orWhere('email', $facebookUser->getEmail())
      ->first();

    if ($existingUser) {
      Auth::login($existingUser, true);
    } else {
      $newUser = User::create([
        'name' => $facebookUser->getName(),
        'email' => $facebookUser->getEmail(),
        'provider_id' => $facebookUser->getId(),
        'provider' => 'facebook',
        'avatar' => $facebookUser->getAvatar(),
        'password' => Hash::make(Str::random(24)),
      ]);
      Auth::login($newUser, true);
    }

    return redirect()->intended('/dashboard');
  }


  public function redirectToInstagram()
  {
    return Socialite::driver('instagram')->redirect();
  }

  public function handleInstagramCallback()
  {
    try {
      $instagramUser = Socialite::driver('instagram')->user();
    } catch (\Exception $e) {
      return redirect('/login')->with('failed', 'Something went wrong or you denied the app.');
    }

    $existingUser = User::where('provider_id', $instagramUser->getId())
      ->orWhere('email', $instagramUser->getEmail())
      ->first();

    if ($existingUser) {
      Auth::login($existingUser, true);
    } else {
      $newUser = User::create([
        'name' => $instagramUser->getName(),
        'email' => $instagramUser->getEmail(),
        'provider_id' => $instagramUser->getId(),
        'provider' => 'instagram',
        'avatar' => $instagramUser->getAvatar(),
        'password' => Hash::make(Str::random(24)),
      ]);
      Auth::login($newUser, true);
    }

    return redirect()->intended('/dashboard');
  }
}
