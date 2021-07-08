@extends('layouts.app')

@section('content')

<div class="container">
    <div class="heading">
      
    </div>
</div>
<div class="container text-center" id="notLogged-links">
    <small class="text-muted" >
        By signing up, you confirm that you have read and agreed to the terms of our <a href="">privacy policy</a> 
    </small>
    <div class="flex my-4">
        <div class="link-card shadow-sm" onclick="exOrg()">
            <div class="link-header">
                <img src="{{asset('images')}}/existing.svg" alt="existing">
            </div>
            <div class="link-text">
                <div class="large">
                    Register to existing organisation
                </div>
                <div class="small">
                    Your request to join will be sent to the organisations admin for verification
                </div>
            </div>
        </div>
        
        <script>
            function exOrg() {
                var url = "<?php echo route('regOrg')?>"
                window.location = url

            }

        </script>
        <div class="link-card shadow-sm" onclick="newOrg()">
            <div class="link-header">
                <img src="{{asset('images')}}/createOrg.svg" alt="existing">
            </div>
            <div class="link-text">
                <div class="large">
                    create a new organisation
                </div>
                <div class="small">
                    Once you create an organisation.You are automaticaly registered as the admin
                </div>
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="my-4"><a href="{{route('loggedin?')}}" class="font-weight-bolder text-muted">&#8592; Go back to home</a></div><div><a href="" class="font-weight-bolder text-muted">Privacy policy</a></div>
    </div>
    <script>
        function newOrg() {
            var url = "<?php echo route('regOrg')?>"
            window.location = url

        }

        function exOrg() {
            var url = "<?php echo route('exOrga')?>"
            window.location = url

        }

    </script>

</div>
@endsection
