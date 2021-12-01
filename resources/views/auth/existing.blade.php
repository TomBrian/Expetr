@extends('layouts.app')
{{-- register to an existing org --}}
@section('content')
    <div class="container">
        <div class="container bg-white shadow-md lg:p-3 md:p-3" id="notLogged-links" style="display: flex;">
            <form method="POST" id="login" class="lg:p-5 md:p-5" action="{{ route('register') }}">
                <div class="header">
                    <h3>Request the organisation code from your team's account administrator.</h3>
                    <p class="my-3 text-muted">After signing up, verify your email address and await admin approval</p>
                </div>

                {{-- <div class="form-title" style="text-transform:uppercase;">{{ __('Register to an existing organisation') }}</div> --}}
                @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif
                @csrf
                <input id="organisation" type="text" placeholder="organisation Code..."
                    class="form-control @error('organisation') is-invalid @enderror" name="organisation"
                    value="{{ old('organisation') }}" required autocomplete="organisation" autofocus>

                @error('organisation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <input id="name" type="text" placeholder="your name..."
                    class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                    autocomplete="name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <input id="email" type="email" placeholder="your email..."
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="password-group">
                    <input id="password" type="password" placeholder="password..."
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">

                    <div class="spacer p-2"></div>

                    <input id="password-confirm" type="password" placeholder="confirm password..." class="form-control"
                        name="password_confirmation" required autocomplete="new-password">

                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="flex">
                    <button type="submit" class="btn m-2 btn-primary">
                        {{ __('Register') }}
                    </button>
                    <a href="{{ route('regOrg') }}">
                        <button type="button" class="btn m-2 shadow-sm btn-light">
                            {{ __('create a team') }}
                        </button>
                    </a>
                </div>
                <div class="flex my-3"><small>Already have an account? <a href="{{ route('login') }}">log
                            in</a></small>
                </div>
            </form>
            <div class="image bg-dark" style="background-image: url('{{ asset('images/form background.png') }}')">

            </div>
        </div>
    </div>

@endsection
