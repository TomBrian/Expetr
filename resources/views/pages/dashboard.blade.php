<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{asset('images')}}/favicon.svg" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
        <title>
            {{$organisation}}
        </title>   
    </head>

       <body>
       
        <div id="content">
            <dashboard></dashboard>
        </div>
        <div class="footer text-center bg-light text-muted">
            <small>&copy;{{Date('Y')}} Expetr expense tracking and analysis system</small>
                 </div>
 <script src="{{asset('js')}}/app.js"></script>
         </body>

</html>
