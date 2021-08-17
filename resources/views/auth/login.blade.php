@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white" id="notLogged-links" style="display: flex;justify-content:center;\">
    <form method="POST" id="login" class="shadow-sm card my-3" action="{{ route('login') }}">
        <div class="form-title">
            {{__('LOGIN')}}
        </div>
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        @csrf
        <input id="organisation" type="text" placeholder="organisation Code..."
            class="form-control @error('organisation') is-invalid @enderror" name="organisation_code"
            value="{{ old('organisation') }}" required autocomplete="organisation">
        @error('organisation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input id="email" type="email" placeholder="your email address..."
            class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
            autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="password..." name="password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="flex">
            <div class="form-group">
                <div class="flex" style="align-items:center;">
                    <input class="input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="label" style="margin-top:-10px; margin-left:10px;" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    @if (Route::has('password.request'))
                    <u>
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="margin-top:-20px;">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </u>
                    @endif
                </div>
            </div>

        </div>
        <button type="submit" id="btn">
            {{ __('Login') }}
        </button>
        <div class="flex my-1"><small>Dont have an account? <a href="{{route('welcome')}}">register</a></small></div>
    </form>
</div>
<div class="container-fluid bg-white background">
    <div class="content container-fluid p-4"></div>
</div>
@endsection
