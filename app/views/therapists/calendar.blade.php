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
                    <h1 class="page-header"><i class="fa fa-calendar"></i> Mi Calendario</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div id="calendar" class="animated bounceInUp"></div>
                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
            </div>

            <!-- /.row -->
            <script>
                function getCalendar(id){
                    $('#calendar').addClass('bounceInUp').fullCalendar({
                        theme: true,
                        defaultView: 'agendaWeek',
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'agendaWeek,agendaDay'
                        },
                        allDaySlot: false,
                        slotDuration: '00:15:00',
                        scrollTime: '07:00:00',
                        minTime: '07:00:00',
                        maxTime: '20:00:00',
                        weekends: true,
                        defaultDate: new Date(),
                        timeFormat: 'H:mm',
                        editable: false,
                        eventLimit: true, // allow "more" link when too many events
                        eventSources: [
                            {
                                url: '/calendar/hours',
                                type: 'POST',
                                data: {
                                    id: id
                                }
                            }
                        ]
                    });
                }
                getCalendar({{$therapist->id}})
            </script>
        </div>

    </div>
    <!-- /#wrapper -->

@stop