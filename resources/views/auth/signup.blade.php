@extends('layouts.auth')

{{-- @section('content')
  <main class="form-signin">
    <form action="/signup" method="POST">
      @csrf

      <img class="mb-4" src="/assets/img/palmtree-silhouette.svg" alt="Palm Tree" width="72" height="57">
      <h1 class="h3 fw-normal">Sign Up</h1>
      <small class="text-center d-block mb-3">it's quite easy</small>

      <div class="form-floating">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name@example.com" value="{{ old('name') }}" autocomplete="off" required>
        <label for="name">Fullname</label>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="name@example.com" value="{{ old('username') }}" autocomplete="off" required>
        <label for="username">Username</label>
        @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" autocomplete="off" required>
        <label for="email">Email address</label>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="my-2">
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}

        @error('g-recaptcha-response')
          <span class="help-block text-danger">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
          </span>
        @enderror
      </div>

      <div class="mb-2 @error('password') mt-4 @enderror">
        Already have an account?
        <a href="/" class="text-decoration-none">Sign In</a>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
      <p class="mt-3 mb-3 text-muted">&copy; SPK Objek Wisata {{ now()->year }}</p>
    </form>
  </main>
@endsection --}}

@section('content')
<div class="container">
  <div class="login-wrapper">
      
      <!-- Text Section -->
      <div class="login-text">
          <h1>Welcome Back!</h1>
          <p>Ayo buat akun dahulu</p>
      </div>
      
      <!-- Form Section -->
      <div class="login-form">
          <h3>Register</h3>
          

          <form action="/signup" method="POST">
              @csrf
              <div class="form-group first">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                  <label for="name">Fullname</label>
                  @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>

              <div class="form-group">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="off" required>
                  <label for="username">Username</label>
                  @error('username')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>

              <div class="form-group">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="off" required>
                  <label for="email">Email address</label>
                  @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>

              <div class="form-group last mb-4">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                  <label for="password">Password</label>
                  @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>

              <div class="my-2">
                  {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display() !!}

                  @error('g-recaptcha-response')
                  <span class="help-block text-danger">
                      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                  </span>
                  @enderror
              </div>

              <div class="mb-2 @error('password') mt-4 @enderror">
                  Sudah Punya Akun?
                  <a href="/" class="text-decoration-none">Login</a>
              </div>

              <button class="w-100 btn btn-lg bgbtnN" type="submit">Register</button>
              <p class="mt-3 mb-3 text-muted">&copy; FitSolusi {{ now()->year }}</p>

              <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>

              <div class="social-login">
                <a href="{{route('auth.facebook')}}" class="social-btn facebook">Facebook</a>
                <a href="#" class="social-btn twitter">Twitter</a>
                <a href="#" class="social-btn google">Google</a>
            </div>
          </form>
      </div>
  </div>
</div>
@endsection
