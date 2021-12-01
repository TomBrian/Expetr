@extends('layouts.app')
{{-- the form to create a new org --}}
@section('content')
    <div class="container">
        <div class="container shadow-md bg-white" id="notLogged-links" style="display: flex;">
            <form method="POST" id="login" class="p-5 card bg-white" action="{{ route('createOrg') }}">
                <div class="header-text">
                    <h3>Create a team account and start adding members !</h3>
                    <p class="my-3 text-muted">
                        Once you submit this form, an organisation code will be generated and sent to the email you provide.
                        use it to log in and then confirm the email.
                    </p>
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
                    <a href="{{ route('exOrga') }}">
                        <button type="button" class="btn m-2 shadow-sm btn-light">
                            {{ __('Join existing team') }}
                        </button>
                    </a>
                </div>
                <div class="flex my-3"><small>Already have an account? <a href="{{ route('login') }}">log
                            in</a></small></div>
            </form>
            <div class="image bg-dark" style="background-image: url('{{ asset('images/form background.png') }}')">

            </div>
        </div>
    </div>
@endsection
