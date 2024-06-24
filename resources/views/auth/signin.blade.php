@extends('layouts.auth')



@section('content')
 
<div class="container cs">
  <div class="login-wrapper">
      
      <!-- Text Section -->
      <div class="login-text">
          <h1>Welcome Back!</h1>
          <p>Login dengan akun yang sudah di buat</p>
      </div>
      
      <!-- Form Section -->
      <div class="login-form">
          <h3>Login</h3>
          <form action="/login" method="POST">
              @csrf
              <div class="form-group">
                  <label for="username">User Name</label>
                  <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required autocomplete="off" autofocus>
                  @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                  @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-check">
                  <input type="checkbox" id="remember_me" class="form-check-input">
                  <label for="remember_me" class="form-check-label">Remember me</label>
                  <a href="{{route('password.halaman')}}" class="forgot-password">Forgot your password?</a>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
              <p class="signup-link">New User? <a href="/signup">Signup</a></p>
          </form>
          <div class="divider">or login with</div>
          <div class="social-login">
              <a href="{{route('auth.facebook')}}" class="social-btn facebook">Facebook</a>
              <a href="#" class="social-btn twitter">Twitter</a>
              <a href="#" class="social-btn google">Google</a>
          </div>
          <p class="footer">&copy; FitSolusi {{ now()->year }}</p>
      </div>
  </div>
</div>

@endsection
