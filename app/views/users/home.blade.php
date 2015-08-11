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
                    <h1 class="page-header">Dashboard</h1>
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
                                <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addCalendar"><i class="fa fa-calendar-plus-o"></i> Añadir</a>
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

                                alert('Event: ' + calEvent.title);
                                alert('View: ' + view.name);

                                // change the border color just for fun
                                $(this).css('border-color', 'red');

                            },
                            allDaySlot:false,
                            slotDuration:'00:15:00',
                            scrollTime:'07:00:00',
                            minTime:'07:00:00',
                            maxTime:'20:00:00',
                            weekends:true,
                            defaultDate: new Date(),
                            timeFormat:'H:mm',
                            editable: false,
                            eventLimit: true, // allow "more" link when too many events
                            events: [
                                {
                                    title: 'Claudia del Campo / Eduardo Ortega',
                                    start: '2015-07-31T16:00:00',
                                    end: '2015-07-31T16:30:00'
                                },
                                {
                                    title: 'Gloria Jury / Eduardo Ortega',
                                    start: '2015-07-31T16:30:00',
                                    end: '2015-07-31T17:00:00'
                                },
                                {
                                    title: 'Juanito Perez / Eduardo Ortega',
                                    start: '2015-07-31T16:30:00',
                                    end: '2015-07-31T17:00:00'
                                },
                                {
                                    title: 'Leonardo Hidalgo / Eduardo Ortega',
                                    start: '2015-07-31T17:00:00',
                                    end: '2015-07-31T17:30:00'
                                },
                                {
                                    title: 'Claudia del Campo / Eduardo Ortega',
                                    start: '2015-07-31T17:30:00',
                                    end: '2015-07-31T17:00:00'
                                },
                                {
                                    title: 'Long Event',
                                    start: '2015-02-07',
                                    end: '2015-02-10'
                                },
                                {
                                    id: 999,
                                    title: 'Repeating Event',
                                    start: '2015-02-09T16:00:00'
                                },
                                {
                                    id: 999,
                                    title: 'Repeating Event',
                                    start: '2015-02-16T16:00:00'
                                },
                                {
                                    title: 'Conference',
                                    start: '2015-02-11',
                                    end: '2015-02-13'
                                },
                                {
                                    title: 'Meeting',
                                    start: '2015-02-12T10:30:00',
                                    end: '2015-02-12T12:30:00'
                                },
                                {
                                    title: 'Lunch',
                                    start: '2015-02-12T12:00:00'
                                },
                                {
                                    title: 'Meeting',
                                    start: '2015-02-12T14:30:00'
                                },
                                {
                                    title: 'Happy Hour',
                                    start: '2015-02-12T17:30:00'
                                },
                                {
                                    title: 'Dinner',
                                    start: '2015-02-12T20:00:00'
                                },
                                {
                                    title: 'Birthday Party',
                                    start: '2015-02-13T07:00:00'
                                },
                                {
                                    title: 'Click for Google',
                                    url: 'http://google.com/',
                                    start: '2015-08-11'
                                }
                            ]
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