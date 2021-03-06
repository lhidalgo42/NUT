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
                    <h1 class="page-header">Menu de Administrador</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <h2>Terapeutas
                        <small>Claves por defecto 4 ultimos digitos del rut.</small>
                    </h2>
                    <div class="col-md-12">
                        <span class="col-md-3"><h3>Nombre</h3></span>
                        <span class="col-md-2"><h3>Acceso</h3></span>
                        <span class="col-md-3"><h3>Color</h3></span>
                        <span class="col-md-3 col-md-offset-1"><h3>Porcentaje Comisión</h3></span>
                        <!-- <h3>Contraseña</h3></span> -->
                    </div>
                    @foreach($therapists as $therapist)
                        <div class="row" style="padding-bottom: 15px;">
                            <div class="col-md-3">
                                <strong>{{$therapist->name}}</strong>
                            </div>
                            <div class="col-md-2">

                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" access="0" therapist-id="{{$therapist->id}}"
                                            class="btn btn-default @if($therapist->access == 0)active @endif access">
                                        NO
                                    </button>
                                    <button type="button" access="1" therapist-id="{{$therapist->id}}"
                                            class="btn btn-default @if($therapist->access == 1)active  @endif access">
                                        SI
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                {{Form::select('color', $colorLists, $therapist->colors_id ,array('class' => 'form-control color','therapist-id' => $therapist->id)) }}
                            </div>
                            <div class="col-md-3 col-md-offset-1">
                                <input type="number" class="form-control" therapist-id ="{{$therapist->id}}" value="{{$therapist->percentage}}">
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2>Editar Duraciones</h2>
                        <table class="table table-hover table-condensed">
                            <tr>
                                <th>Duracion</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                            <tbody id="tbody-duration">
                            @foreach($durations as $duration)
                                <tr>
                                    <td>{{$duration->name}}</td>
                                   <td><a href="#" duration-id="{{$duration->id}}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                                    <td><a href="#" duration-id="{{$duration->id}}"><i class="fa fa-close fa-2x"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-success" id="addDuration">Agregar Nueva Duración</a>
                        <script>
                            $("#addDuration").click(function(){
                                $("#modalDuration").modal('show');
                            });

                        </script>
                    </div>
                    <div class="col-md-12">
                        <h2>Editar Colores</h2>
                        <table class="table table-hover table-condensed">
                            <tr>
                                <th>Nombre</th>
                                <th colspan="2">Texto</th>
                                <th colspan="2">Border</th>
                                <th colspan="2">fondo</th>
                            </tr>
                            <tbody id="tbody-colors">
                            @foreach($colors as $color)
                                <tr>
                                    <td>{{$color->name}}</td>
                                    <td>{{$color->text}}</td>
                                    <td><button class="btn" style="background-color: {{$color->text}}"></button> </td>
                                    <td>{{$color->border}}</td>
                                    <td><button class="btn" style="background-color: {{$color->border}}"></button> </td>
                                    <td>{{$color->color}}</td>
                                    <td><button class="btn" style="background-color: {{$color->color}}"></button> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-success" id="addDuration">Agregar Nuevo Color</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
    <div class="modal fade" id="modalDuration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="selectDuration">
                        <option value="0">Seleccione Minutos</option>
                        @foreach(range(1,120) as $min)
                            <?php
                            $bloob = 0;
                            $tim = $min * 60; ?>
                            @foreach($durations as $duration)
                                @if($duration->timestamp == $tim)
                                    <?php $bloob =1; ?>
                                @endif
                            @endforeach
                                    @if($bloob == 0)
                                        <option value="{{$tim}}">{{$min}} Minutos</option>
                                    @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveDuration">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- /#wrapper -->
    <script>
        $(".color").change(function () {
            $.ajax({
                url: "/therapist/color",
                data: {
                    color: $(this).val(),
                    therapist: $(this).attr('therapist-id')
                },
                type: "POST",
                success: function (data) {
                }
            });
            $(this).parent().children("button").removeClass('disabled active')
            $(this).addClass('disabled active')
        });

        $(".access").click(function () {
            $.ajax({
                url: "/therapist/access",
                data: {
                    access: $(this).attr('access'),
                    therapist: $(this).attr('therapist-id')
                },
                type: "POST",
                success: function (data) {
                }
            });
            $(this).parent().children("button").removeClass('active');
            $(this).addClass('active')
        });

    </script>
    <script>

        $("#saveDuration").click(function () {
            $.ajax({
                url: "/duration/new",
                type: "POST",
                data: {
                    timestamp: $("#selectDuration").val()
                },
                success: function (data) {
                    var min = $("#selectDuration").val() / 60;
                    $("#tbody-duration").append(
                            '<tr>' +
                            '<td>' + min + ' Minutos</td>' +
                            '</tr>');
                    $("#modalDuration").modal('hide');
                }
            });
        });
    </script>
@stop