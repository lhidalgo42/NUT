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
                            {{$therapist->name}}
                        </div>
                        <div class="col-md-3" access="true">
                            <h3>Acceso</h3>
                            <div class="btn-group" role="group" aria-label="..." therapist-id="{{$therapist->id}}">
                                <button type="button" access="0" class="btn btn-danger @if($therapist->access == 0)active @endif">NO</button>
                                <button type="button" access="1" class="btn btn-success @if($therapist->access == 1)active @endif">SI</button>
                            </div>
                        </div>
                        <div class="col-md-6" colors>
                            <h3>Nombre de Terapeuta</h3>
                            @foreach($colors as $color)
                            <button type="button" color-id="{{$color->id}}" therapist-id="{{$therapist->id}}" class="btn {{$color->className}} @if($therapist->colors_id == $color->id) active @endif " style="color: {{$color->text}};background-color:{{$color->color}};border-color:{{$color->border}};">{{$color->name}}</button>
                            @endforeach
                        </div>
                    </div>

                @endforeach
                {{$therapists}}

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop