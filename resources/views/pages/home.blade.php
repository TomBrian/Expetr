@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white p-7" id="notLogged-links">
 <div class="link-cards container flex">
    <div class="card bg-white shadow-sm link-card mx-7 p-3">
        <div class="icon">
          <img src="{{asset('images/createOrg.svg')}}" alt="create new organisation"/>
        </div>
        <div class="text">
           <h5 class="my-3 font-weight-bold text-center">Create a new organisation</h5>
           <p class="text-muted text-center">
             Once you have created an organisation, you will be automatically registered as an administrator.
             An organisation code will be generated and sent to your email.This code will be used when registering new members in your organisation.
           </p>
        </div>
        <div class="card-foot">
          <button class="button py-2 text-center" onclick="window.location = '{{route('regOrg')}}'">
             <span class="font-weight-bold">
               Create organisation
             </span>
          </button>
        </div>
    </div>
    <div class="card bg-white shadow-sm link-card mx-7 p-3">
      <div class="icon">
        <img src="{{asset('images/existing.svg')}}" alt="create new organisation"/>
      </div>
      <div class="text">
         <h5 class="my-3 font-weight-bold text-center">Register to an existing organisation</h5>
         <p class="text-muted text-center">
         Send a join request to an organisation that already has an account through registering with their organisation code (<b>contact existing members for the code</b>).
         Once the request has been approved you will be able to access the dashboard
        </p>
      </div>
      <div class="card-foot">
        <button class="button py-2 text-center"  onclick="window.location = '{{route('exOrga')}}'">
           <span class="font-weight-bold">
             Register
           </span>
        </button>
      </div>
  </div>
 </div>
</div>
<div class="container-fluid bg-white background">
<div class="content container-fluid p-4"></div>
</div>
@endsection
