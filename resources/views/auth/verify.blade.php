@extends('layouts.app')

@section('content')
    <div class="flex-wrapper">
        <div class="container-fluid bg-white flex justify-items-center align-items-center" id="notLogged-links">
            <div class="card shadow-lg p-4 my-2 text-center" style="width: 400px; margin:auto; border:none;">
                <h3 class="font-weight-bold my-4" style="color: blue">Verify Email</h3>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <h5>{{ __('Before proceeding, please check your email for a verification link.') }}</h5>
                <div class="my-4">
                    <small class="text-muted">
                        We need to verify that you are the owner of the email you registered with.
                    </small>
                </div>
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                        class="btn button btn-primary align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white background">
        <div class="content container-fluid p-4"></div>
    </div>
@endsection
