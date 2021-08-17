<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@900&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Expetr expense traking and analysis') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body id="content">
<nav class="navbar navbar-expand-sm navbar-light flex shadow-sm bg-light" id="landingNav">
    <div><a class="navbar-brand mx-2 " href="{{route('loggedin?')}}"><img
       src="{{asset('images')}}/logo-light.svg" style="width:110px" alt=""></a></div>
@if (Auth::check())
<button class="btn btn-light mx-3 font-weight-bold text-primary" onclick="window.location = '{{route('dashboard')}}'">
        Go To Dashboard
</button>
@else
<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
aria-expanded="false" aria-label="Toggle navigation">
<img src="{{asset('images/menu-white.svg')}}" alt="">
</button>
<div class="collapse navbar-collapse" id="collapsibleNavId">
<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link text-white" href="{{route('login')}}">Login</a>
    </li>
    <li class="nav-item">
        <button class="btn btn-light mx-3 font-weight-bold text-primary" onclick="window.location = '{{route('welcome')}}'">
            Try it now
        </button>
    </li>
</ul>

</div>

@endif
</nav>
<div class="hero">
<div class="overlay">
<div class="text text-center" style="width:40%;">
    <h1 class="font-weight-bolder text-light" style="font-family:Poppins;"> 
    Expetr provides vital business management tools to help you track growth
    </h1>
    <p class="paragraph" style="color: rgb(238, 238, 238);">
    Track and analyse your expenses,Manage events and assign tasks all on one dashboard.
    </p>        
    <button class="cta px-3 btn btn-lg py-1">
       <b class="mx-3"> <a href="{{route('welcome')}}" class="nav-link">Get started</a>  </b> 
       <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="8.5" cy="8.5" r="8.5" fill="#514EFF"/>
        <path d="M5 8.5H12.5" stroke="white"/>
        <path d="M8 4L12.5 8.5L8 13" stroke="white"/>
        </svg>
           
    </button>
</div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#006AFF" fill-opacity="1" d="M0,32L80,53.3C160,75,320,117,480,138.7C640,160,800,160,960,144C1120,128,1280,96,1360,80L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
  </svg>
</div>
<div style="width: 100%; display:flex; justify-content:center;">
<h3 class="font-weight-bolder text-primary text-center after-hero" style="font-family:Poppins; width:70%; "> 
    It's more than management.It's a way of building team spirit among your organisation's staff
</h3>
</div>
<p class="text-muted text-center" style="margin-top:10px;">Expetr brings you tools that are created to
     help you build team spirit among your staff members</p>
<h2 class="text-center my-5" style="color:orange;">Management tools we offer</h2>
<div class="container-fluid svg">
    <h3 class="font-weight-bolder lg-none">Expense recording and processing</h3>
    <div class="hero-text text-left px-5">

        <h3 class="font-weight-bolder sm-none">Expense recording and processing</h3>
        <p class="text-muted">
            Your expenses are recorded and grouped into nine categories through a series of data processing operations.
            Both overall and category totals are calculated and stored as history for analysis.
            The records are available as a pdf copy to all members any time.
        </p>
        </div>
     <div class="hero-image px-4">
        <img src="{{asset('images/expenses.svg')}}" alt="">
    </div>
    </div>
<div class="container-fluid svg my-5 py-4">
    <h3 class="font-weight-bolder lg-none">Expense analysis</h3>
<div class="hero-image px-4">
    <img src="{{asset('images/landing.svg')}}" alt="">
</div>
<div class="hero-text text-left px-5">
    <h3 class="font-weight-bolder sm-none">Expense analysis</h3>
    <p class="text-muted">
        An accurate graphical representation of your expense growth is provided on both monthly and annual records.
    </p>
    </div>
</div>
<div class="container-fluid svg my-5 py-4">
    <h3 class="font-weight-bolder lg-none">Task assignment</h3>
    <div class="hero-text text-left px-5">
        <h3 class="font-weight-bolder sm-none">Task assignment</h3>
        <p class="text-muted">
          We help you assign tasks and track their progress.
        </p>
    </div>
        <div class="hero-image px-4">
            <img src="{{asset('images/tasks.svg')}}" style="width: 70%;" alt="">
        </div>
</div>

<style>
.svg{
    display:flex;
    height: fit-content;
    justify-content: space-between;
    align-items: center;
    width:80%;
    margin: auto;
    flex-direction:row;
}
@media (max-width:900px){
    .svg{
        flex-direction:column;
        width:100% !important;
    }
    .hero-image{
        width: 100% !important;
    }
    .hero-text{
        width:100% !important;
    }
}
.svg h3{
    color:orange;
}
.hero-image{
width: 50%
}
.hero-image img{
width: 90%;
margin: auto
}
.hero-text{
    width: 50%;
}
.hero{
    width: 100%;
    height:60vh;
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
    margin-top: 0% !important;
}
.overlay{
    background-color:#006aff;
    width:100%;
    height: fit-content;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top:10px;
}
@media (max-width:900px){
    .overlay .text{
        width: 80% !important;
    }
    h1{
        font-size:20px;
    }
    h3{
        font-size: 17px;
    }
    .hero{
        height: 50vh;
    }
    .after-hero{
        margin-top:0px !important;
        display: flex;
        justify-self: center;
    }
}
.cta{
background-color: white;
color: #006AFF;
border-radius: 37px;
margin-top:20px;
display: flex;
align-items: center;
margin: auto
}
.after-hero{
    margin-top:90px;
}

</style>
<div class="footer text-center bg-light text-muted" style="position:relative !important;">
    <small>&copy;{{Date('Y')}} Expetr business management system</small>
         </div>
</body>

</html>
