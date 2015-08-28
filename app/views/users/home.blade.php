@extends('layouts.master')

@section('content')
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('navs.top')
        @include('navs.left')
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-home"></i> Inicio</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-calendar"></i> Calendario
                            <div class="pull-right">
                                <a href="/calendar/add" class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Añadir </a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="calendar"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
               @include('schedule.addCalendar')

                <script>
                        $('#calendar').fullCalendar({
                            theme: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            eventClick: function(calEvent, jsEvent, view) {



                            },
                            allDaySlot:false,
                            slotDuration:'00:15:00',
                            scrollTime:'07:00:00',
                            weekends:true,
                            defaultDate: new Date(),
                            timeFormat:'H:mm',
                            editable: true,
                            eventLimit: true, // allow "more" link when too many events
                            events: {{json_encode($datos)}}

                        });
                </script>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-money"></i> Pagos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-user"></i> Leonardo Hidalgo
                                    <span class="pull-right text-muted small"><em>50.000</em>
                                    </span>
                                </a>

                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ver Todos los Pagos Pendientes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop