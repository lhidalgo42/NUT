<div class="modal fade" id="viewCalendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Informacion</h4>
            </div>
            <div class="modal-body">

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