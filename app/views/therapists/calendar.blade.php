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
                    <h1 class="page-header">Terapeutas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" id="calendar-div" style="display: none;">
                <div id="calendar"></div>
                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
            </div>
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
                                        '<td style="text-align: center;"><a href="#" class="btn btn-primary" therapist-name ="'+data[i]['name']+'" therapist-phone="'+data[i]['phone']+'" therapist-cellphone="'+data[i]['cellphone']+'" therapist-id="' + data[i]['id'] + '"> Seleccionar</a></td>' +
                                        '</tr>');
                            }
                            $("#therapist-body a").click(function () {
                                $(this).attr('disabled', 'disabled');
                                var id = $(this).attr('therapist-id');
                                $("#addDuration").attr('therapist-id',id);
                                $("#therapist").val($(this).attr('therapist-name'));
                                $.ajax({
                                    url: "/therapist/duration",
                                    type: "POST",
                                    data: {
                                        id: id
                                    },
                                    success: function (data) {
                                        var table = $("#body-table");
                                        table.html('');
                                        for(var i = 0;i<data.length;i++){
                                            table.append('<tr>'+
                                                    '<td>'+data[i]['name']+'</td>'+
                                                    '<td><a href="#" duration-id="'+data[i]['id']+'" therapist-id="'+id+'" ><i class="fa fa-2x fa-times text-danger"></i></a></td>'+
                                                    '</tr>');
                                        }
                                        $("#body-table a").click(function(){
                                            $.ajax({
                                                url: "/therapist/duration/delete",
                                                type: "POST",
                                                data: {
                                                    id: $(this).attr('duration-id'),
                                                    therapist:$(this).attr('therapist-id')
                                                }
                                            });
                                            $(this).parent().parent().remove();
                                        });

                                    }
                                });

                            });
                        }
                    });
                });

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
                                id:
                            },
                            error: function () {
                                alert('El Terapeuta no Registra Horas.');
                            }
                        }

                        // any other sources...

                    ]
                });
            </script>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <!-- Modal -->
        <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="dataTitle">Terapeuta Agregar/Editar</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::hidden('id',Input::old('id'),array('id'=> 'id'))}}
                        <div class="form-group">
                            <label for="rut">RUT</label>
                            {{ Form::text('rut', Input::old('rut'), array('placeholder' => 'RUT','class' => 'form-control','id' => 'rut')) }}
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            {{ Form::text('name', Input::old('name'), array('placeholder' => 'Nombre','class' => 'form-control','id' => 'name')) }}
                        </div>
                        <div class="form-group">
                            <label for="birth">Fecha de Nacimiento</label>
                            {{ Form::text('birth', Input::old('birth'), array('placeholder' => 'Fecha de Nacimiento','class' => 'form-control','id' => 'birth')) }}
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono Fijo</label>
                            {{ Form::text('phone', Input::old('phone'), array('placeholder' => 'Telefono Fijo','class' => 'form-control','id' => 'phone')) }}
                        </div>
                        <div class="form-group">
                            <label for="cellphone">Telefono Celular</label>
                            {{ Form::text('cellphone', Input::old('cellphone'), array('placeholder' => 'Telefono Celular','class' => 'form-control','id' => 'cellphone')) }}
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{ Form::email('email', Input::old('email'), array('placeholder' => 'Email','class' => 'form-control','id' => 'email')) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="save" style="display: block;">Guardar Cambios</button>
                        <button type="button" class="btn btn-primary" id="save2" style="display: none;">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <script>

        </script>

    </div>
    <!-- /#wrapper -->

@stop