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
                <div class="col-lg-12" style="padding-bottom: 15px;">
                    <h1 class="page-header">Salas y Salones</h1>
                    <span class="pull-right">
                        <select name="time" id="time" class="form-control">
                            <option value="0">Seleccione Periodo de Tiempo</option>
                            <option value="weakly">Semanalmente</option>
                            <option value="monthly">Mensual</option>
                            <option value="yearly">Anualmente</option>
                        </select>
                        <a href="#" id="printer" class="btn btn-small btn-info" style="width: 300px;">Version Para Imprimir</a></span>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row" style="background-color: whitesmoke;opacity: 1">
                <table class="table table-bordered img-rounded"
                       style="position: absolute;width: 75%;opacity: 1;background-color: white;">
                    <tr>
                        <th>SALA</th>
                        <th>Terapeuta</th>
                        <th>Hora Inicio</th>
                        <th>Hora de Termino</th>
                    </tr>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ Form::select(
                                    'rooms',
                                    array_merge(['' => 'Seleccione Sala'], $rooms),
                                    $schedule->rooms_id,
                                    array(
                                        'class' => 'form-control',
                                        'schedule-id' => $schedule->id
                                    ))}}</td>
                            <td>{{$schedule->name}}</td>
                            <td>{{$schedule->start}}</td>
                            <td>{{$schedule->end}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <script>
            $("select[name='rooms']").change(function () {
                $.ajax({
                    url: '/rooms/update/therapist',
                    type: 'POST',
                    data: {
                        room: $(this).val(),
                        schedule: $(this).attr('schedule-id')
                    },
                    success: function (data) {

                    }
                })
            });
            $("#printer").click(function(){
               var link = "/print/room";
                var time = $("#time").val();
                if(time != 0){
                    window.location.href = link+"/"+time;
                }
                else {
                    sweetAlert("Oops...", "Tiene que Seleccionar un Periodo de Tiempo", "error");
                }
            });
        </script>
    </div>
    <!-- /#wrapper -->

@stop