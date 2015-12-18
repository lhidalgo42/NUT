<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NUT</title>

    <!-- Bootstrap Core CSS -->
    <link href="/packages/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/packages/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/css/timeline.css" rel="stylesheet">

    <link href="http://fullcalendar.io/js/fullcalendar-2.3.2/lib/cupertino/jquery-ui.min.css" rel='stylesheet'>

    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/fade.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/packages/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/packages/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- FullCalendar CSS -->
    <link href="/packages/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/packages/fullcalendar/dist/fullcalendar.print.css" rel='stylesheet' media='print' />

    <!-- Bootstrap DateTimePicker -->
    <link href="/packages/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>

    <!-- DataTables -->
    {{HTML::style('/packages/datatables/media/css/jquery.dataTables.min.css')}}

            <!-- DataTables Plugins Bootstrap-->
    {{HTML::style('/packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}
    {{HTML::style('/packages/sweetalert/dist/sweetalert.css')}}
    {{HTML::style('/packages/animate.css/animate.min.css')}}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .sombra{
            margin: 0 auto;
            -moz-box-shadow: 0px 5px 20px #ccc;
            -webkit-box-shadow: 0px 5px 20px #ccc;
            box-shadow: 0px 5px 20px #ccc;
        }
        #dtes > tbody > tr >td{
            text-align:center
        }
    </style>

    <!-- jQuery -->
    <script src="/packages/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/packages/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/packages/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Moment Plugin JavaScript -->
    <script src="/packages/moment/min/moment-with-locales.min.js"></script>

    <!-- fullcalendar Plugin JavaScript -->
    <script src="/packages/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src='/packages/fullcalendar/dist/lang/es.js'></script>

    <!-- Typehead Plugin JavaScript -->
    <script src="/js/bootstrap-typeahead.min.js"></script>

    <!-- Typehead Plugin JavaScript -->
    <script src="/packages/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/packages/raphael/raphael-min.js"></script>
    <script src="/packages/morrisjs/morris.min.js"></script>

    <!-- Sweetalert JavaScript -->
    <script src="/packages/sweetalert/dist/sweetalert.min.js"></script>

    <!-- DataTables -->
    <script src='/packages/datatables/media/js/jquery.dataTables.min.js'></script>
    <script src='/packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js'></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>
</head>

<body>
<img id="bg" src="/img/fondo.jpg" class="fadebgin-1">
<script>
    $(document).ready(function(){
        var ahs = 0;
        var fondos = ['fondo.jpg','fondo1.jpg','fondo2.jpg'];
        setInterval(function(){
            if(fondos.length == ahs+1){ahs = 0;}
            $("#bg").removeClass('fadebgin-1').addClass('fadebgout-1');
            setTimeout(function(){
                $("#bg").attr('src','/img/'+fondos[ahs]).removeClass('fadebgout-1').addClass('fadebgin-1');
            },1000);
            ahs++;
        },900000);
    });
</script>
@yield('content')

@if(Session::has('success'))
    <script>
        swal({
            title: "Proceso Exitoso",
            text: "{{Session::get('success')}}",
            timer: 2000,
            showConfirmButton: false,
            type: "success"
        });
    </script>
@endif
@if(Session::has('error'))
    <script>
        swal({
            title: "Proceso Exitoso",
            text: "{{Session::get('error')}}",
            timer: 2000,
            showConfirmButton: false,
            type: "error"
        });
    </script>
@endif
</body>

</html>