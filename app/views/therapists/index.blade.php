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
                    <h1 class="page-header">Terapeutas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <table id="dtes" class="table table-striped table-bordered">
                    <thead style="background-color: white;position: relative;">
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Fecha de Creacion</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                    </thead>
                    <tbody>
                    @foreach($therapists as $therapist)
                        <tr>
                            <td>{{$therapist->rut}}</td>
                            <td>{{$therapist->name}}</td>
                            <td>{{$therapist->birth}}</td>
                            <td>{{$therapist->phone}}</td>
                            <td>{{$therapist->cellphone}}</td>
                            <td>{{$therapist->email}}</td>
                            <td>{{$therapist->created_at}}</td>
                            <td class="text-info"><a href="#{{$therapist->id}}"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-danger"><a href="#{{$therapist->id}}"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function(){
                    $('#dtes').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                        }
                    });
                });
            </script>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@stop