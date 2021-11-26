@extends('layouts.app')
{{-- the form to create a new org --}}
@section('content')
<div id="app">
    <div class="container-fluid bg-white p-7"  id="notLogged-links" style="display: flex; justify-content:center;">
        <form method="POST" id="login" class="shadow-sm my-3 card bg-white" action="{{ route('createOrg') }}">
            <div style="width:fit-content;margin:auto">
                <img src="{{asset('images')}}/createOrg.svg" class="form-icon my-2">
            </div>
            {{-- <div class="form-title" style="text-transform:uppercase;">{{ __('create a new organisation') }}</div> --}}

            @csrf
            @method('GET')
            <input id="organisation" type="text" placeholder="organisation name..."
                class="form-control @error('organisation') is-invalid @enderror" name="organisation_name"
                value="{{ old('organisation') }}" required autocomplete="organisation">

            @error('organisation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input id="name" type="text" placeholder="your(admin) name..."
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                autocomplete="name" autofocus>

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

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password-confirm" type="password" placeholder="confirm password..." class="form-control"
                name="password_confirmation" required autocomplete="new-password">
</div>
       <button type="submit" id="btn">
                {{ __('Register') }}
            </button>
            <div class="flex my-3"><small>Already have an account? <a href="{{route('login')}}">log in</a></small></div>
        </form>
    </div>
    <div class="container-fluid bg-white background">
        <div class="content container-fluid p-4"></div>
</div>
@endsection
