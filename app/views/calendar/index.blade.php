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
                    <h1 class="page-header">Calendar</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div id="calendar"></div>
            </div>
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
                    events: []
                });
            </script>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop