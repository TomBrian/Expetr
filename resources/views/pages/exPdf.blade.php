<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon">
<title>{{$organisation->name}}</title>
</head>
<body>
    <div class="body">
 <style>
     .body{
         width:100%;
         font-family:'sans-serif';
     }
     .logo{
         margin: auto !important;
         color: blue;
         margin-bottom: 6px;
     }
     td{
         padding :15px;
         border:solid 1px grey;
     }
     th{ background:#efefef;
         color: grey;
         padding: 10px;
         border-left:solid 1px grey;
         border-bottom:solid 1px grey;
     }
 </style>
 <div><small style="color:grey;font-weight:bold; margin-bottom:10px;"><i>As of <?php echo date('d/m/Y')?></small></i></div>
 <div>
     @if (Auth::check())
         <small style="color:grey;font-weight:bold; margin-bottom:10px; float:right;"><i>{{Auth::user()->name}}'s copy</small></i>
     @endif
</div>
<div class="container text-center my-3">
    <h1>{{$organisation->name}}'s expenses</h1> 
</div>
<hr>
<div class="my-6" style="margin-bottom: 20px;">
    <?php
    $total = 0;
       for ($i=0; $i < count($expenses); $i++) { 
           $expense = $expenses[$i];
           if ($expense->status == 'approved') {
               $total += $expense->amount;
           } 
       }
       echo "<b>Total: ".$total."</b>"
        ?>
</div>
<table class="table shadow-sm table-striped table-inverse table-hover table-bodered">
    <thead class="thead thead-inverse">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>author</th>
            <th>amount</th>
            <th>date</th>
            <th>category</th>
            <th>status</th>
          
        </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
            <tr >
                <th scope="row">{{$expense->id}}</th>
                <td>{{$expense->title}}</td>
                <td>{{$expense->description}}</td>
                <td>{{$expense->author}}</td>
                <td>{{$expense->amount}}</td>
                <td>{{$expense->created_at}}</td>
                <td>{{$expense->category}}</td>
                <td>
                 {{$expense-> status}}
                </td>
            </tr>
            @endforeach
            
             
        </tbody>
</table>
<div class="footer text-center bg-light text-muted" style="position:relative !important;">
    <small>&copy;{{Date('Y')}} Expetr business management system</small>
         </div>
</div>
</body>
</html>
