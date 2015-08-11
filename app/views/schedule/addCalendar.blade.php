<div class="modal fade" id="addCalendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agendar Nueva Hora</h4>
            </div>
            <div class="modal-body">
                {{Form::open(array('url' => '/schedule/create', 'method' => 'post'))}}
                <div class="form-group col-sm-6">
                    <label for="patient">Paciente</label>
                    {{ Form::text('patient', Input::old('patient'), array('placeholder' => 'Paciente','class' => 'form-control','id' => 'patient')) }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="therapist">Terapeuta</label>
                    {{ Form::text('therapist', Input::old('therapist'), array('placeholder' => 'Terapeuta','class' => 'form-control','id' => 'therapist')) }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="room">Salon</label>
                    {{ Form::text('room', Input::old('room'), array('placeholder' => 'Salon','class' => 'form-control','id' => 'room')) }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="start">Comienza</label>
                    {{ Form::text('start', Input::old('start'), array('placeholder' => 'Comienza','class' => 'form-control','id' => 'start')) }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="duration">Duración</label>
                    {{ Form::text('duration', Input::old('duration'), array('placeholder' => 'Duración','class' => 'form-control','id' => 'duration')) }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="price">Precio</label>
                    {{ Form::text('price', Input::old('price'), array('placeholder' => 'Precio','class' => 'form-control','id' => 'price')) }}
                </div>

                {{Form::close()}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="send">Agendar Nueva Hora</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $('#patient').typeahead({
        ajax: '/patient/list'
    });
    $("#patient").change(function(){

    });
    $('#therapist').typeahead({
        ajax: '/therapist/list'
    });
    $('#room').typeahead({
        ajax: '/room/list'
    });
    $(function () {
        $('#start').datetimepicker();
    });
    function enviar(){

    }

</script>