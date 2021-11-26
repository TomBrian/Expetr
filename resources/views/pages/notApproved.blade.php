@extends('layouts.app')

@section('content')
<div class=" px-9 text-center container-fluid flex align-items-center bg-white" id="notLogged-links">
    <div class="card bg-white p-3 my-3" style="width: 400px;margin:auto; display:flex;flex-direction:column;justify-content:center; align-items:center;">
<h5 class="font-weight-bold my-3">howdy, {{$myName}}</h5>
<p class="text-muted">
 Admins at {{$organisation}} are yet to approve your join request.
come back later and you'll be redirected to the organisation account once your request has been received and approved.
<b>(You will be notified through the email you registered once you are appoved)</b>
</p>
<button class="btn btn-lg btn-secondary shadow-sm my-3"><a href="{{ route('logout') }}" class="text-light" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
    Logout
</a>    
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
</button>
</div>
</div>
<div class="container-fluid bg-white background">
    <div class="content container-fluid p-4"></div>
</div>
@endsection
