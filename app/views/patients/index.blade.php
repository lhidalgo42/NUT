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
                    <th>Editar</th>
                    <th>Borrar</th>
                    </thead>
                    <tbody>
                    @foreach($patients as $patient)
                        <tr id="dat-id-{{$patient->id}}">
                            <td>@if($patient->rut != ""){{$patient->rut}}@else - @endif</td>
                            <td>@if($patient->name != ""){{$patient->name}}@else - @endif</td>
                            <td>@if($patient->birth != ""){{$patient->birth}}@else - @endif</td>
                            <td>@if($patient->phone != ""){{$patient->phone}}@else - @endif</td>
                            <td>@if($patient->cellphone != ""){{$patient->cellphone}}@else - @endif</td>
                            <td>@if($patient->email != ""){{$patient->email}}@else - @endif</td>
                            @if($patient->addedByUserId == Auth::user()->id || \Role::find(\Auth::user()->roles_id)->name != "Terapeuta")
                                <td><a href="#" class="text-info"><i class="fa fa-pencil-square-o fa-2x"
                                                                     style="margin-left: 20px;"
                                                                     patient-id="{{$patient->id}}"></i></a></td>
                                <td><a href="#" class="text-danger"><i class="fa fa-trash-o fa-2x"
                                                                       style="margin-left: 20px;"
                                                                       patient-id="{{$patient->id}}"></i></a></td>
                            @else
                                <td> -</td>
                                <td> -</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a id="create" class="btn btn-success" style="position: relative;">Agregar Nuevo Paciente</a>
            </div>
            <script>
                $(document).ready(function () {
                    var table = $('#dtes').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                        }
                    });
                    $('#dtes tbody').on('click', 'i.fa-trash-o', function () {
                        table.row($(this).parents('tr')).remove().draw();
                        $.ajax({
                            url: "/patient/delete/" + $(this).attr('patient-id'),
                            type: "POST"
                        });
                    });
                    $('#dtes tbody').on('click', 'i.fa-pencil-square-o', function () {
                        $("#save").removeAttr('style');
                        $("#save2").css('display', 'none');
                        $.ajax({
                            url: "/patient/show/" + $(this).attr('patient-id'),
                            type: "POST",
                            success: function (data) {
                                $("#dataTitle").html('Editar ' + data.name);
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

                    });
                    $("#create").click(function () {
                        $("#save2").removeAttr('style');
                        $("#save").css('display', 'none');
                        $("#dataModal").modal('show');
                    });
                    $("#cancel").click(function () {
                        $("#dataModal").modal('hide');
                        $("#dataTitle").html('Paciente Agregar/Editar');
                        $("#id").val('');
                        $("#rut").val('');
                        $("#name").val('');
                        $("#birth").val('');
                        $("#phone").val('');
                        $("#cellphone").val('');
                        $("#email").val('');
                    });

                    $("#save2").click(function () {
                        if (Rut($("#rut").val())) {
                            if ($("#name").val() != '') {
                                if ($("#phone").val() != '' || $("#cellphone").val() != '') {
                                    if (validaPatient($("#rut").val())) {
                                        $.ajax({
                                            url: "/patient/create",
                                            type: "POST",
                                            data: {
                                                rut: $("#rut").val(),
                                                name: $("#name").val(),
                                                birth: $("#birth").val(),
                                                phone: $("#phone").val(),
                                                cellphone: $("#cellphone").val(),
                                                email: $("#email").val()
                                            },
                                            success: function (data) {
                                                table.row.add([
                                                    data.rut,
                                                    data.name,
                                                    data.birth,
                                                    data.phone,
                                                    data.cellphone,
                                                    data.email,
                                                    '<a href="#" class="text-info"><i class="fa fa-pencil-square-o fa-2x" style="margin-left: 20px;" patient-id="' + data.id + '"></i></a>',
                                                    '<a href="#" class="text-danger"><i class="fa fa-trash-o fa-2x" style="margin-left: 20px;" patient-id="' + data.id + '"></i></a>'
                                                ]).draw();
                                                $("#dataModal").modal('hide');
                                                $("#dataTitle").html('Paciente Agregar/Editar');
                                                $("#id").val('');
                                                $("#rut").val('');
                                                $("#name").val('');
                                                $("#birth").val('');
                                                $("#phone").val('');
                                                $("#cellphone").val('');
                                                $("#email").val('');
                                            }
                                        });
                                    } else {
                                        sweetAlert("Oops...", "El Paciente ya Existe en la Base de Datos", "warning");
                                    }
                                } else {
                                    sweetAlert("Oops...", "El Telefono es un Dato Obligatorio", "warning");
                                }
                            } else
                                sweetAlert("Oops...", "El Nombre es un Dato Obligatorio", "warning");
                        }
                        else {
                            sweetAlert("Oops...", "El rut ingresado no es válido", "warning");
                        }
                    });
                 /*   $("#rut").focusout(function() {
                              validaPatient($( this).val(),function(data){
                                   if(!data){
                                       sweetAlert("Oops...", "El paciente ya existe en la base de datos.", "warning");
                                   }
                               });

                            }
                    ); */
                    $("#save").click(function () {
                        if (Rut($("#rut").val())) {
                            if ($("#name").val() != '') {
                                if ($("#phone").val() != '' || $("#cellphone").val() != '') {
                                            $.ajax({
                                                url: "/patient/save",
                                                type: "POST",
                                                data: {
                                                    id: $("#id").val(),
                                                    rut: $("#rut").val(),
                                                    name: $("#name").val(),
                                                    birth: $("#birth").val(),
                                                    phone: $("#phone").val(),
                                                    cellphone: $("#cellphone").val(),
                                                    email: $("#email").val()
                                                },
                                                success: function (data) {
                                                    table.row($("i.fa-pencil-square-o[patient-id='" + data.id + "']").parents('tr')).remove().draw();
                                                    table.row.add([
                                                        data.rut,
                                                        data.name,
                                                        data.birth,
                                                        data.phone,
                                                        data.cellphone,
                                                        data.email,
                                                        '<a href="#" class="text-info"><i class="fa fa-pencil-square-o fa-2x" style="margin-left: 20px;" patient-id="' + data.id + '"></i></a>',
                                                        '<a href="#" class="text-danger"><i class="fa fa-trash-o fa-2x" style="margin-left: 20px;" patient-id="' + data.id + '"></i></a>'
                                                    ]).draw();
                                                    $("#dataModal").modal('hide');
                                                    $("#dataTitle").html('Terapeuta Agregar/Editar');
                                                    $("#id").val('');
                                                    $("#rut").val('');
                                                    $("#name").val('');
                                                    $("#birth").val('');
                                                    $("#phone").val('');
                                                    $("#cellphone").val('');
                                                    $("#email").val('');
                                                }
                                            });

                                } else {
                                    sweetAlert("Oops...", "El Telefono es un Dato Obligatorio", "warning");
                                }
                            } else
                                sweetAlert("Oops...", "El Nombre es un Dato Obligatorio", "warning");
                        }
                        else {
                            sweetAlert("Oops...", "El rut ingresado no es válido", "warning");

                        }

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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="dataTitle">Paciente Agregar/Editar</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::hidden('id',Input::old('id'),array('id'=> 'id'))}}
                        <div class="form-group">
                            <label for="rut">RUT</label>
                            {{ Form::text('rut', Input::old('rut'), array('placeholder' => 'RUT','class' => 'form-control','id' => 'rut','required' => 'required')) }}
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            {{ Form::text('name', Input::old('name'), array('placeholder' => 'Nombre','class' => 'form-control','id' => 'name','required' => 'required')) }}
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
                            {{ Form::text('cellphone', Input::old('cellphone'), array('placeholder' => 'Telefono Celular','class' => 'form-control','id' => 'cellphone','required' => 'required')) }}
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{ Form::email('email', Input::old('email'), array('placeholder' => 'Email','class' => 'form-control','id' => 'email')) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="save" style="display: block;">Guardar
                            Cambios
                        </button>
                        <button type="button" class="btn btn-primary" id="save2" style="display: none;">Guardar
                            Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $('#birth').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'es',
                    viewMode: 'years'
                });
            });
        </script>

    </div>
    <!-- /#wrapper -->

@stop