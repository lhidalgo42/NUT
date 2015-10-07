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
                <h2>Terapeutas</h2>
                @foreach($therapists as $therapist)
                    <div class="row" style="margin-bottom: 55px;">
                        <div class="col-md-3">
                            <h3>Nombre</h3>
                            <strong>{{$therapist->name}}</strong>
                        </div>
                        <div class="col-md-3">
                            <h3>Acceso</h3>
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" access="0" therapist-id="{{$therapist->id}}" class="btn btn-danger @if($therapist->access == 0)active disabled @endif access">NO</button>
                                <button type="button" access="1" therapist-id="{{$therapist->id}}" class="btn btn-success @if($therapist->access == 1)active disabled @endif access"> SI</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Nombre de Terapeuta</h3>
                            @foreach($colors as $color)
                            <button type="button" color-id="{{$color->id}}" therapist-id="{{$therapist->id}}" class="btn {{$color->className}} @if($therapist->colors_id == $color->id) active disabled @endif color" >{{$color->name}}</button>
                            @endforeach
                        </div>
                    </div>

                @endforeach

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script>
        $(".color").click(function(){
            $.ajax({
                url: "/therapist/color",
                data: {
                    color : $(this).attr('color-id'),
                    therapist: $(this).attr('therapist-id')
                },
                type:"POST",
                success: function( data ) {
                    $(this).parent().children("button").removeClass('disabled active')
                    $(this).addClass('disabled active')
                }
            });
        });

        $(".access").click(function(){
            $.ajax({
                url: "/therapist/access",
                data: {
                    access : $(this).attr('access'),
                    therapist: $(this).attr('therapist-id')
                },
                type:"POST",
                success: function( data ) {
                    $(this).parent().children("button").removeClass('disabled active');
                    $(this).addClass('disabled active')
                }
            });
        });

    </script>
@stop