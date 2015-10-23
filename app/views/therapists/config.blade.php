@extends('layouts.master')

@section('content')
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('navs.top')
        @include('navs.left')
        </nav>


        <div id="page-wrapper" style="background-color: whitesmoke;opacity: 1">
            <div class="row" style="opacity: 1;">
                <div class="col-lg-12">
                    <h1 class="page-header">Configuraciones Terapeutas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
            <h3 class="col-lg-12 h3">Duracion de las Horas</h3>
            <div class="col-lg-6 animated fadeInLeft" id="therapist-div" style="display: block;">
                <h4 class="h4">Seleccione Terapeuta</h4>
                <div class="form-group">
                    <label for="therapist">Terapeuta</label>
                    {{ Form::text('therapist', Input::old('therapist'), array('placeholder' => 'Terapeuta','class' => 'form-control','id' => 'therapist','autocomplete' => 'off')) }}
                </div>
                <table class="table table-bordered"  style="background-color: white;position: relative;" id="table">
                    <tr>
                        <th>Nombre</th>
                        <th style="text-align: center;">  </th>
                    </tr>
                    <tbody id="therapist-body">

                    </tbody>
                </table>
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
            </script>
                <div class="col-lg-6 animated fadeInRight">
                    <h4 class="h4">Duraciones Activas</h4>
                    <table class="table" style="background-color: white;position: relative;" >
                        <tr>
                            <th colspan="2">Duracion</th>
                        </tr>
                        <tbody id="body-table" ></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"><a href="#" class="btn btn-info btn-block" id="addDuration" therapist-id="0">Agregar Nueva</a> </td>
                            </tr>
                        </tfoot>
                    </table>
                    <script>
                        $("#addDuration").click(function(){
                            $("#save").attr('therapist-id',$(this).attr('therapist-id'));
                           if($('#therapist').val() == ''){
                               alert('Debe Seleccionar un Terapeuta Primero');
                           }
                            else{
                               $.ajax({
                                   url: "/therapist/duration/new",
                                   type: "POST",
                                   data: {
                                       id: $(this).attr('therapist-id')
                                   },
                                   success:function(data){
                                    var select = $("#selectDuration");
                                       select.html('');
                                       for(var i = 0;i<data.length;i++){
                                           select.append('<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>')
                                       }
                                       $("#durationModal").modal('show');
                                        }
                           });
                               }
                        });
                    </script>
                </div>
                <div class="modal fade" id="durationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Seleccione Horas a Agregar</h4>
                            </div>
                            <div class="modal-body">
                                <select class="form-control" id="selectDuration">

                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="save" therapist-id="0">Guardar</button>
                            </div>
                            <script>
                                $("#save").click(function(){
                                    if($("#selectDuration").val() == ''){
                                        alert('No selecciono ninguna Duracion');
                                    }
                                    else{
                                        var therapist = $(this).attr('therapist-id');
                                        var id = $("#selectDuration").val();
                                        $.ajax({
                                            url: "/therapist/duration/save",
                                            type: "POST",
                                            data: {
                                                id: id,
                                                therapist: therapist
                                            },
                                            success: function (data) {
                                                if(data == 1){
                                                   $("#durationModal").modal('hide');
                                                    $.ajax({
                                                        url: "/therapist/duration",
                                                        type: "POST",
                                                        data: {
                                                            id: therapist
                                                        },
                                                        success: function (data) {
                                                            var table = $("#body-table");
                                                            table.html('');
                                                            for(var i = 0;i<data.length;i++){
                                                                table.append('<tr>'+
                                                                        '<td>'+data[i]['name']+'</td>'+
                                                                        '<td><a href="#" duration-id="'+data[i]['id']+'" therapist-id="'+therapist+'" ><i class="fa fa-2x fa-times text-danger"></i></a></td>'+
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
                                                }
                                            }
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop