@extends('layouts.app')
{{-- register to an existing org --}}
@section('content')
<div class="container" style="display: flex;justify-content:center;align-items:center; height:120vh;">
    <form method="POST" id="login" class="shadow-sm" action="{{ route('register') }}">

        {{-- <div style="width:fit-content;margin:auto">
            <img src="{{asset('images')}}/existing.svg" class="form-icon">
        </div> --}}


        <div class="form-title" style="text-transform:uppercase;">{{ __('Register to an existing organisation') }}</div>
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


        <input id="name" type="text" placeholder="your name..." class="form-control @error('name') is-invalid @enderror"
            name="name" value="{{ old('name') }}" required autocomplete="name" >

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


        <input id="email" type="email" placeholder="your email..."
            class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
            autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

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



        <button type="submit" id="btn">
            {{ __('Register') }}
        </button>
<div class="flex my-3"><small>Already have an account? <a href="{{route('login')}}">log in</a></small></div>
    </form>
</div>
@endsection
