<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
    <head>
    @include('includes.landing.meta')
    <title>@yield('title') | FitSolusi</title>
    <link rel="shortcut icon" href="{{asset('assets/logo.svg')}}">
        @stack('before-style')
        @include('includes.landing.style')
        @stack('after-style')
    </head>
    <body class="antialiased">
        <div class="relative container ">
            @include('includes.landing.header')
            @yield('content')
         @include('includes.landing.footer')
            @stack('before-script')
            @include('includes.landing.script')
            @stack('after-script')


    {{--modals--}}
{{-- 
            @include('components.Modal.login')
            @include('components.Modal.register-succes')
            @include('components.Modal.register')  --}}
        </div>
    </body>
</html>