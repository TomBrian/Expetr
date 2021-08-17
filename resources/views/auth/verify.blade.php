@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white flex justify-items-center align-items-center" id="notLogged-links">
<div class="card p-4 my-5 text-center" style="width: 400px; margin:auto;">
    <h5 class="font-weight-bold" style="color: orange">Verify Email</h5>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
@endif
    <p><em>{{ __('Before proceeding, please check your email for a verification link.') }}</em></p>
    <p class="text-muted">
        We need to verify that you are the owner of the email you registered with.
    </p>
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn button btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
    </form>
</div>
</div>
<div class="container-fluid bg-white background">
    <div class="content container-fluid p-4"></div>
</div>
@endsection
