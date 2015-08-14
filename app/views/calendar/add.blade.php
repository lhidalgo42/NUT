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
            <div class="row" id="inputs">
                <div class="col-lg-6"  id="patient-div">
                    <div class="form-group">
                        <label for="patient">Paciente</label>
                        {{ Form::text('patient', Input::old('patient'), array('placeholder' => 'Paciente','class' => 'form-control','id' => 'patient','autocomplete' => 'off')) }}

                    </div>
                    <table class="table table-bordered"  style="background-color: white;position: relative;">
                        <tr>
                            <th>Nombre</th>
                            <th style="text-align: center;"> / </th>
                        </tr>
                        <tbody id="patient-body">
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6" id="therapist-div" style="display: none;">
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
            </div>
            <div class="row" id="calendar-div" style="display: none;">
                    <div id="calendar"></div>
                <script>

                    $('#patient').keyup(function(){
                        $.ajax({
                            url: "/patient/list",
                            type: "POST",
                            data:{
                                name:$("#patient").val()
                            },
                            success:function(data){
                                $("#patient-body").html('');
                                for(var i =0;i<data.length;i++){
                                    $("#patient-body").append('<tr>' +
                                                                '<td style="text-align: center;">'+data[i]['name']+'</td>' +
                                                                '<td style="text-align: center;"><a href="#" class="btn btn-primary" patient-name ="'+data[i]['name']+'" patient-phone="'+data[i]['phone']+'" patient-cellphone="'+data[i]['cellphone']+'" patient-id="'+data[i]['id']+'"> Seleccionar</a></td>' +
                                                              '</tr>');
                                }
                                $("#patient-body a").click(function(){
                                    $(this).attr('disabled','disabled');
                                    $("#therapist-div").css('display','block').addClass('fadein-1');
                                    $("#table-patient-name").html($(this).attr('patient-name'))
                                    $("#table-patient-cellphone").html($(this).attr('patient-cellphone'));
                                    $("#table-patient-phone").html($(this).attr('patient-phone'))
                                });
                            }
                        });
                    });
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
                                                        '<td style="text-align: center;"><a href="#" class="btn btn-primary" therapist-name ="'+data[i]['name']+'" therapist-phone="'+data[i]['phone']+'" therapist-cellphone="'+data[i]['cellphone']+'" therapist-id="' + data[i]['id'] + '"> Seleccionar</a></td>' +
                                                        '</tr>');
                                            }
                                            $("#therapist-body a").click(function () {
                                                $(this).attr('disabled', 'disabled');
                                                var id = $(this).attr('therapist-id');
                                                $("#inputs").addClass('fadeout-1');
                                                $("#table-therapist-name").html($(this).attr('therapist-name'));
                                                $("#table-therapist-cellphone").html($(this).attr('therapist-cellphone'));
                                                $("#table-therapist-phone").html($(this).attr('therapist-phone'));
                                                setTimeout(function(){
                                                    $("#inputs").css('display', 'none');
                                                    $("#calendar-div").css('display', 'block').addClass('fadein-1');
                                                    $('#calendar').fullCalendar({
                                                        theme: true,
                                                        header: {
                                                            left: 'prev,next today',
                                                            center: 'title',
                                                            right: 'month,agendaWeek,agendaDay'
                                                        },
                                                        dayClick: function (date, jsEvent, view) {

                                                            //alert('Clicked on: ' + date.format()+' / '+view.name);
                                                            $("#resumen").modal('show');
                                                            $("#table-time").html(date.format());

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
                                                                    alert('there was an error while fetching events!');
                                                                }
                                                            }

                                                            // any other sources...

                                                        ]
                                                    });
                                                },1000);
                                            });
                                        }
                                    });
                                });
                    $("#next2").click(function() {
                        $("#therapist-div").addClass('fadeout-1');
                        $("#next2").addClass('fadeout-1');
                        setTimeout(function () {


                        }, 1000);
                    });
                </script>

                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <div class="modal fade" id="resumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /#wrapper -->

@stop