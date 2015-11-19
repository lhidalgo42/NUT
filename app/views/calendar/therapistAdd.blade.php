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
                <div class="col-md-12 animated bounceInUp" id="patient-div">
                    <div class="form-group">
                        <label for="patient">Paciente</label>
                        {{ Form::text('patient', Input::old('patient'), array('placeholder' => 'Paciente','class' => 'form-control','id' => 'patient','autocomplete' => 'off')) }}

                    </div>
                    <table class="table table-bordered" style="background-color: white;position: relative;">
                        <tr>
                            <th>Nombre</th>
                            <th style="text-align: center;"> /</th>
                        </tr>
                        <tbody id="patient-body">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" id="calendar-div" style="display: none;">
                <div id="calendar"></div>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Resumen</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td colspan="2"><strong>Terapeuta</strong></td>
                                <td colspan="2" id="table-therapist-name">{{$therapist->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Celular</strong></td>
                                <td id="table-therapist-cellphone">{{$therapist->cellphone}}</td>
                                <td><strong>Telefono</strong></td>
                                <td id="table-therapist-phone">{{$therapist->phone}}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Paciente</strong></td>
                                <td colspan="2" id="table-patient-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Celular</strong></td>
                                <td id="table-patient-cellphone"></td>
                                <td><strong>Telefono</strong></td>
                                <td id="table-patient-phone"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Hora de Inicio</strong></td>
                                <td colspan="2" id="table-time" class="h4" data="0"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Duracion</td>
                                <td colspan="2"><select class="form-control" name="duration" id="duration"></select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><input id="observation" name="observation" placeholder="Observaciones"
                                                       class="form-control" style="width: 100%"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Precio</strong></td>
                                <td colspan="2"><input id="price" name="price" placeholder="Precio" class="form-control"
                                                       style="width: 100%"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <a href="#" class="btn btn-primary" id="save" patient-id="0">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#patient').keyup(function () {
                $.ajax({
                    url: "/patient/list",
                    type: "POST",
                    data: {
                        name: $("#patient").val()
                    },
                    success: function (data) {
                        $("#patient-body").html('');
                        for (var i = 0; i < data.length; i++) {
                            $("#patient-body").append('<tr>' +
                                    '<td style="text-align: center;">' + data[i]['name'] + '</td>' +
                                    '<td style="text-align: center;"><a href="#" class="btn btn-primary" patient-name="' + data[i]['name'] + '" patient-phone="' + data[i]['phone'] + '" patient-cellphone="' + data[i]['cellphone'] + '" patient-id="' + data[i]['id'] + '"> Seleccionar</a></td>' +
                                    '</tr>');
                        }
                        $("#patient-body a").click(function () {
                            $("#save").attr('patient-id', $(this).attr('patient-id'));
                            $('#patient').val($(this).attr('patient-name'));
                            $(this).attr('disabled', 'disabled');
                            $("#therapist-div").css('display', 'block').addClass('fadein-1');
                            $("#table-patient-name").html($(this).attr('patient-name'));
                            $("#table-patient-cellphone").html($(this).attr('patient-cellphone'));
                            $("#table-patient-phone").html($(this).attr('patient-phone'))
                            $("#inputs").addClass('fadeout-1');
                            $.ajax({
                                url: "/therapist/duration",
                                type: "POST",
                                data: {
                                    id: {{$therapist->id}}






                                },
                                success: function (data) {
                                    var duration = $("#duration");
                                    duration.html('');
                                    for (var i = 0; i < data.length; i++) {
                                        duration.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>');
                                    }
                                }
                            });
                            setTimeout(function () {
                                $("#inputs").css('display', 'none');
                                $("#calendar-div").css('display', 'block').addClass('fadein-1');
                                $('#calendar').fullCalendar({
                                    theme: true,
                                    defaultView: 'agendaWeek',
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'agendaWeek,agendaDay'
                                    },
                                    dayClick: function (date, jsEvent, view) {

                                        //alert('Clicked on: ' + date.format()+' / '+view.name);
                                        $("#resumen").modal('show');
                                        $("#table-time").html(date.format('DD') + ' de ' + date.format('MMMM') + ' del ' + date.format('YYYY, h:mm:ss a')).attr('data', date.format());

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
                                                id: {{$therapist->id}}





                                            },
                                            error: function () {
                                                swal('Aviso', 'El terapeuta no registra horas, porfavor haga click en el dia y hora que desea.', 'warning')
                                            }
                                        }

                                        // any other sources...

                                    ]
                                });
                            }, 1000);
                        });
                    }
                });
            });
            $("#save").click(function () {
                $("#resumen").modal('hide');
                $.ajax({
                    url: "/schedule/create",
                    type: "POST",
                    data: {
                        therapist: {{$therapist->id}},
                        patient: $(this).attr('patient-id'),
                        start: $("#table-time").attr('data'),
                        duration: $("#duration").val(),
                        observation: $("#observation").val(),
                        price: $("#price").val()
                    },
                    success: function (data) {
                        window.location.href = '/';
                    }
                });
            });
        </script>
    </div>

    <!-- /#wrapper -->

@stop