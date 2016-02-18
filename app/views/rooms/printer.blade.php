@extends('layouts.master')

@section('content')
    <div id="wrapper">


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom: 15px;">
                    <h1 class="page-header">Salas y Salones</h1>
                    <span class="pull-right"><a href="/print/version/room" class="btn btn-small btn-info">Version Para Imprimir</a></span>
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
            })
        </script>
    </div>
    <!-- /#wrapper -->

@stop