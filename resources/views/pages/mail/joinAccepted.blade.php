<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Expetr expense tracking and analysis | Your organisation code</title>
</head>
<body>
   <div class="card" style="border: solid 1px rgba(0, 0, 255, 0.151); width:fit-content; margin:auto; padding:20px; border-radius:20px; display:flex; flex-direction:column !important; justify-content:center;">
       <div class="card-body">
        <h1 style="color:blue;margin:auto; width:fit-content;">Expetr.com</h1>  
        <p class="card-text">Hello {{$userName}}.Welcome to expetr.com.</p>
         <p><b>{{$acceptorName}} accepted your join request.Log in to access {{$organisation_name}}'s dashboard</b></p>
         <p>Visit our help center for any inquiries.To make changes to your account, go to the advanced/account tab.</p>
        <small style="color:grey;">Please do not reply to this message</small>
          <hr>
          <div style=" width:fit-content; margin:auto;"><small style="color:grey;">&copy;{{Date('Y')}} Expetr expense tracking and analysis system</small></div>
        </div>
   </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>