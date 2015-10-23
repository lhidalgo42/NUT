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
            <div class="col-md-8">
                <h2>Terapeutas
                    <small>Claves por defecto 4 ultimos digitos del rut.</small>
                </h2>
                <div class="col-md-12">
                    <span class="col-md-3"><h3>Nombre</h3></span>
                    <span class="col-md-3"><h3>Acceso</h3></span>
                    <span class="col-md-3"><h3>Color</h3></span>
                    <span class="col-md-3"><h3>Contraseña</h3></span>
                </div>
                @foreach($therapists as $therapist)
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-md-3">
                            <strong>{{$therapist->name}}</strong>
                        </div>
                        <div class="col-md-3">

                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" access="0" therapist-id="{{$therapist->id}}"
                                        class="btn btn-danger @if($therapist->access == 0)active disabled @endif access">
                                    NO
                                </button>
                                <button type="button" access="1" therapist-id="{{$therapist->id}}"
                                        class="btn btn-success @if($therapist->access == 1)active disabled @endif access">
                                    SI
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{Form::select('color', $colors, $therapist->colors_id ,array('class' => 'form-control color','therapist-id' => $therapist->id)) }}
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>

            @endforeach
            </div>
            <div class="col-md-4">
                <h2>Editar Duraciones</h2>
                <table class="table table-hover table-condensed">
                    <tr>
                        <th>Duracion</th>
                        <th>Editar</th>
                        <!-- <th>Borrar</th> -->
                    </tr>
                    <tbody>
                    @foreach($durations as $duration)
                        <tr>
                            <td>{{$duration->name}}</td>
                            <td><a><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
                            <!--<td><a><i class="fa fa-close fa-2x"></i></a></td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="#" class="btn btn-success">Agregar Nueva Duración</a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

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
            $(this).parent().children("button").removeClass('disabled active');
            $(this).addClass('disabled active')
        });

    </script>
@stop