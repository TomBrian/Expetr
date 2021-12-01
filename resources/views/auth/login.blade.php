@extends('layouts.app')
{{-- the form to logn in --}}
@section('content')
    <div class="container">
        <div class="container shadow-md bg-white" id="notLogged-links" style="display: flex; align-items-center">
            <form method="POST" id="login" class="card p-5 my-3" action="{{ route('login') }}">
                {{ csrf_field() }}
                @method('GET')
                <div class="form-header">
                    <h3>{{ __('welcome back !') }}</h3>
                </div>
                <div class="spacer p-4"></div>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <input id="organisation" type="text" placeholder="organisation Code..."
                    class="form-control @error('organisation_code') is-invalid @enderror" name="organisation_code"
                    value="{{ old('organisation_code') }}" required autocomplete="organisation_code">
                @error('organisation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="email" type="email" placeholder="your email address..."
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email">
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
                                    <a class="btn btn-link" href="{{ route('password.request') }}"
                                        style="margin-top:-20px;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </u>
                            @endif
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
                <div class="flex my-4"><small>Dont have an account? <a
                            href="{{ route('welcome') }}">register</a></small></div>
            </form>
            <div class="image bg-dark" style="background-image: url('{{ asset('images/form background.png') }}')">

            </div>
        </div>
    </div>

@endsection
