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
                    <h1 class="page-header">Pacientes</h1>
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
                    <th>Fecha de Actualizaci&oacute;n</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr id="dat-id-{{$patient->id}}">
                            <td>{{$patient->rut}}</td>
                            <td>{{$patient->name}}</td>
                            <td>{{$patient->birth}}</td>
                            <td>{{$patient->phone}}</td>
                            <td>{{$patient->cellphone}}</td>
                            <td>{{$patient->email}}</td>
                            <td>{{$patient->updated_at}}</td>
                            <td><a href="#" class="text-info"><i class="fa fa-pencil-square-o fa-2x" style="margin-left: 20px;" patient-id="{{$patient->id}}"></i></a></td>
                            <td><a href="#" class="text-danger"><i class="fa fa-trash-o fa-2x" style="margin-left: 20px;" patient-id="{{$patient->id}}"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function(){
                    var table = $('#dtes').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                        }
                    });
                    $('#dtes tbody').on( 'click', 'i.fa-trash-o', function () {
                        table.row( $(this).parents('tr') ).remove().draw();
                        $.ajax({
                            url: "/patient/delete/"+$(this).attr('patient-id'),
                            type: "POST"
                        });
                    } );
                    $('#dtes tbody').on( 'click', 'i.fa-pencil-square-o', function () {
                        $.ajax({
                            url: "/patient/show/"+$(this).attr('patient-id'),
                            type: "POST",
                            success:function(data){
                                $("#dataTitle").html('Editar '+data.name);
                                $("#id").val(data.id);
                                $("#rut").val(data.rut);
                                $("#name").val(data.name);
                                $("#birth").val(data.birth);
                                $("#phone").val(data.phone);
                                $("#cellphone").val(data.cellphone);
                                $("#email").val(data.email);
                                $("#dataModal").modal('show');
                            }
                        });
                    } );
                    $("#save").click(function(){
                        $.ajax({
                            url: "/patient/save",
                            type: "POST",
                            data:{
                                id:$("#id").val(),
                                rut:$("#rut").val(),
                                name:$("#name").val(),
                                birth:$("#birth").val(),
                                phone:$("#phone").val(),
                                cellphone:$("#cellphone").val(),
                                email:$("#email").val()
                            },
                            success:function(data){
                                $("#id").val('');
                                $("#rut").val('');
                                $("#name").val('');
                                $("#birth").val('');
                                $("#phone").val('');
                                $("#cellphone").val('');
                                $("#email").val('');
                            }
                        });
                    });
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
                        <h4 class="modal-title" id="dataTitle">Paciente Agregar/Editar</h4>
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
                        <button type="button" class="btn btn-primary" id="save">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <script>

        </script>

    </div>
    <!-- /#wrapper -->

@stop