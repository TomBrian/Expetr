@extends('layouts.app')

@section('content')
<div class="jumbotron px-9 text-center container flex align-items-center" style="height: 40vh; background:white;">
<h5>howdy, {{$myName}}, Admins at {{$organisation}} are yet to approve your join request.
come back later and you'll be redirected to the organisation account once your request has been received and accepted.
</h5>
</div>
<div class="account-actions container alert-warning p-3" style="width:60%;">
<div class="flex justify-content-center w-full">
    <button class="btn btn-lg shadow-sm btn-primary"><a href="{{ route('logout') }}" class="text-light" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
        Logout
    </a>    
    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form></button>
  
</div>
</div>
@endsection
