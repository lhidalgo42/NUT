<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="/images/favicon.ico" />

    <link href="/packages/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/packages/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <style>
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/packages/jquery/dist/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.0/js/toastr.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/packages/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <div style="text-align: center;padding-top: 30px;" class="" id="logo">
            <img src="/img/logo.png" style="width: 25%">
        </div>
        <div class="col-sm-6 col-md-4 col-md-offset-4 fadein-2" style="display: none;" id="form">
            <div class="account-wall">
                <img class="profile-img" src="img/logo-top.png" alt="">
                {{ Form::open(['route'=> 'sessions.store','class' => 'form-signin']) }}
                {{ Form::email('email', Input::old('email'), array('placeholder' => 'Correo','class' => 'form-control','id' => 'mail','required','autofocus')) }}
                {{ Form::password('password',array('placeholder' => 'Contraseña','class' => 'form-control', 'id' => 'pass' ,'required')) }}
                <div class="input-group">
                    {{ Form::checkbox('remember', true,array('class' => 'form-control')) }} Recordarme
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="login">Ingresar</button>
                @if(Session::has('error'))
                    <span class="text-danger">{{Session::get('error')}}</span>
                @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var timer = setTimeout(function(){
            $("#logo").addClass('fadeout-2');
            var out = setTimeout(function () {
               $("#logo").css('display','none');
                $("#form").css('display','block');

            },2000);
        },2000)
    })
</script>
</body>
</html>
