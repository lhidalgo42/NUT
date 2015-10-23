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
                    <h1 class="page-header">Mis Duraciones</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 animated fadeInRight">
                    <h4 class="h4">Duraciones Activas</h4>
                    <table class="table" style="background-color: white;position: relative;">
                        <tr>
                            <th colspan="2">Duracion</th>
                        </tr>
                        <tbody id="body-table"></tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"><a href="#" class="btn btn-info btn-block" id="addDuration">Agregar Nueva</a></td>
                        </tr>
                        </tfoot>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $.ajax({
                                url: "/therapist/duration",
                                type: "POST",
                                data: {
                                    id: {{$therapist->id}}
                                },
                                success: function (data) {
                                    var table = $("#body-table");
                                    table.html('');
                                    for (var i = 0; i < data.length; i++) {
                                        table.append('<tr>' +
                                                '<td>' + data[i]['name'] + '</td>' +
                                                '<td><a href="#" duration-id="' + data[i]['id'] + '"><i class="fa fa-2x fa-times text-danger"></i></a></td>' +
                                                '</tr>');
                                    }
                                    $("#body-table a").click(function () {
                                        $.ajax({
                                            url: "/therapist/duration/delete",
                                            type: "POST",
                                            data: {
                                                id: $(this).attr('duration-id'),
                                                therapist:{{$therapist->id}}
                                            }
                                        });
                                        $(this).parent().parent().remove();
                                    });
                                }
                            });
                        });

                        $("#addDuration").click(function () {
                            $.ajax({
                                url: "/therapist/duration/new",
                                type: "POST",
                                data: {
                                    id: {{$therapist->id}}
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
                        });
                    </script>
                </div>
                <div class="modal fade" id="durationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Seleccione Horas a Agregar</h4>
                            </div>
                            <div class="modal-body">
                                <select class="form-control" id="selectDuration">

                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="save">Guardar</button>
                            </div>
                            <script>
                                $("#save").click(function(){
                                    if($("#selectDuration").val() == ''){
                                        alert('No selecciono ninguna Duracion');
                                    }
                                    else{
                                        var id = $("#selectDuration").val();
                                        $.ajax({
                                            url: "/therapist/duration/save",
                                            type: "POST",
                                            data: {
                                                id: id,
                                                therapist: {{$therapist->id}}
                                            },
                                            success: function (data) {
                                                    $("#durationModal").modal('hide');
                                                    $.ajax({
                                                        url: "/therapist/duration",
                                                        type: "POST",
                                                        data: {
                                                            id: {{$therapist->id}}
                                                        },
                                                        success: function (data) {
                                                            var table = $("#body-table");
                                                            table.html('');
                                                            for(var i = 0;i<data.length;i++){
                                                                table.append('<tr>'+
                                                                        '<td>'+data[i]['name']+'</td>'+
                                                                        '<td><a href="#" duration-id="'+data[i]['id']+'"><i class="fa fa-2x fa-times text-danger"></i></a></td>'+
                                                                        '</tr>');
                                                            }
                                                            $("#body-table a").click(function(){
                                                                $.ajax({
                                                                    url: "/therapist/duration/delete",
                                                                    type: "POST",
                                                                    data: {
                                                                        id: $(this).attr('duration-id'),
                                                                        therapist:{{$therapist->id}}
                                                                    }
                                                                });
                                                                $(this).parent().parent().remove();
                                                            });

                                                        }
                                                    });

                                            }
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop