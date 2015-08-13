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
                    <h1 class="page-header"><i class="fa fa-home"></i> Crear Hora</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group" id="patient-div">
                        <label for="patient">Paciente</label>
                        {{ Form::text('patient', Input::old('patient'), array('placeholder' => 'Paciente','class' => 'form-control','id' => 'patient','autocomplete' => 'off')) }}
                    </div>
                    <div class="form-group" id="therapist-div" style="display: none;">
                        <label for="therapist">Terapeuta</label>
                        {{ Form::text('therapist', Input::old('therapist'), array('placeholder' => 'Terapeuta','class' => 'form-control','id' => 'therapist','autocomplete' => 'off')) }}
                    </div>
                    <div id="calendar" style="display: none;"></div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-4">
                    <a href="#" class="btn btn-primary btn-block" id="next">Siguente</a>
                    <a href="#" class="btn btn-primary btn-block" id="next2" style="display: none;">Siguente</a>
                    <a href="#" class="btn btn-primary btn-block" id="next3" style="display: none;">Siguente</a>
                </div>
                <script>
                    $('#patient').typeahead({
                        ajax: '/patient/list'
                    });
                    $('#therapist').typeahead({
                        ajax: '/therapist/list'
                    });
                    $("#next").click(function(){
                        if($("#patient").val() == ''){
                            alert('El campo de Paciente esta vacio');
                            return false;
                        }
                        $("#patient-div").addClass('fadeout-1');
                        $("#next").addClass('fadeout-1');
                        setTimeout(function(){
                            $("#patient-div").css('display','none');
                            $("#therapist-div").css('display','block').addClass('fadein-1');
                            $("#next").css('display','none');
                            $("#next2").css('display','block');
                            $("#next2").addClass('fadein-1');
                        },1000);
                    });
                    $("#next2").click(function(){
                        if($("#therapist").val() == ''){
                            alert('El campo de Terapeuta esta vacio');
                            return false;
                        }
                        $("#therapist-div").addClass('fadeout-1');
                        $("#next2").addClass('fadeout-1');
                        setTimeout(function(){
                            $("#therapist-div").css('display','none');
                            $("#calendar").css('display','block').addClass('fadein-1');
                            $("#next2").css('display','none');
                            $("#next3").css('display','block');
                            $("#next3").addClass('fadein-1');
                            $('#calendar').fullCalendar({
                                theme: true,
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'agendaWeek,agendaDay'
                                },
                                dayClick: function(date, jsEvent, view) {

                                    //alert('Clicked on: ' + date.format()+' / '+view.name);
                                        $("#resumen").modal('show');
                                        $("#table-therapist-name").html($("#therapist").val());
                                        $("#table-patient-name").html($("#patient").val());
                                        $("#table-time").html(date.format());

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
                                eventSources: [

                                    // your event source
                                    {
                                        url: '/calendar/hours',
                                        type: 'POST',
                                        data: {
                                            name: $("#therapist").val()
                                        },
                                        error: function() {
                                            alert('there was an error while fetching events!');
                                        }
                                    }

                                    // any other sources...

                                ]
                            });
                        },1000);
                    });
                </script>

                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <div class="modal fade bs-example-modal-lg" id="resumen" tabindex="-1" role="dialog" aria-labelledby="resumen">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="">
                    <table class="table">
                        <tr>
                            <td colspan="2">Terapeuta</td><td colspan="2" id="table-therapist-name"></td>
                        </tr>
                        <tr><td>Celular</td><td id="table-therapist-cellphone"></td><td>Telefono</td><td id="table-therapist-phone"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Paciente</td><td colspan="2" id="table-patient-name"></td>
                        </tr>
                        <tr><td>Celular</td><td id="table-patient-cellphone"></td><td>Telefono</td><td id="table-patient-phone"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Hora de Inicio</td><td colspan="2" id="table-time"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Duracion</td><td colspan="2"></td>
                        </tr>
                    </table>

                </div>
                <button type=button" id="guardar">Guardar</button>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

@stop