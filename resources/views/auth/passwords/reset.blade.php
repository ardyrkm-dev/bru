@extends('layouts.auth')



@section('content')
 
<div class="container cs">
  <div class="login-wrapper">
      
      <!-- Text Section -->
      <div class="login-text">
          <h1>Reset Password</h1>
          <p>Ganti password lama dengan password baru ya</p>
      </div>
      
      <!-- Form Section -->
      <div class="login-form">
        <h1 class="text-2xl font-bold mb-4 text-center">Reset Password</h1>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <button type="submit" class="w-100 mt-2 btn btn-lg bgbtnN">
                    Reset Password
                </button>
            </div>
        </form>
         
         
          <p class="footer">&copy; FitSolusi {{ now()->year }}</p>
      </div>
  </div>
</div>

@endsection



