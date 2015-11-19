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
                    <h1 class="page-header">Calendario de Terapeutas <span class="pull-right small" id="name"></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-md-6 animated bounceInDown" id="therapist-div">
                    <div class="form-group">
                        <label for="therapist">Terapeuta</label>
                        {{ Form::text('therapist', Input::old('therapist'), array('placeholder' => 'Terapeuta','class' => 'form-control','id' => 'therapist','autocomplete' => 'off')) }}
                    </div>
                    <table class="table table-bordered"  style="background-color: white;position: relative;">
                        <tr>
                            <th>Nombre</th>
                            <th style="text-align: center;"> / </th>
                        </tr>
                        <tbody id="therapist-body">

                        </tbody>
                    </table>
                </div>
                <div id="calendar" class="animated"></div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <script>
            $('#therapist').keyup(function() {

                $.ajax({
                    url: "/therapist/list",
                    type: "POST",
                    data: {
                        name: $("#therapist").val()
                    },
                    success: function (data) {
                        $("#therapist-body").html('');
                        for (var i = 0; i < data.length; i++) {
                            $("#therapist-body").append('<tr>' +
                                    '<td style="text-align: center;">' + data[i]['name'] + '</td>' +
                                    '<td style="text-align: center;"><a href="#" class="btn btn-primary" therapist-name="'+data[i]['name']+'" therapist-phone="'+data[i]['phone']+'" therapist-cellphone="'+data[i]['cellphone']+'" therapist-id="' + data[i]['id'] + '"> Seleccionar</a></td>' +
                                    '</tr>');
                        }
                        $("#therapist-body a").click(function () {
                            $(this).attr('disabled', 'disabled');
                            var id = $(this).attr('therapist-id');
                            $('#therapist').val($(this).attr('therapist-name'));
                            $("#name").html($(this).attr('therapist-name')+' <button class="btn btn-success btn-xs" id="change">cambiar</button>');
                            $("#change").click(function(){
                                $("#calendar").removeClass('bounceInUp').addClass('bounceOutDown');
                                $("#therapist-div").addClass('bounceInDown').removeClass('bounceOutUp').css('display','block');
                            });
                            $("#therapist-div").removeClass('bounceInDown').addClass('bounceOutUp');
                            setTimeout(function(){
                                $("#therapist-div").css('display','none');
                            },1000);
                            getCalendar(id)
                        });
                    }
                });
            });
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

                        // your event source
                        {
                            url: '/calendar/hours',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            error: function () {

                            }
                        }

                        // any other sources...

                    ]
                });
            }
        </script>
    </div>
    <!-- /#wrapper -->

@stop