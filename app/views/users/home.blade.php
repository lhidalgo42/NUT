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
                    <h1 class="page-header"><i class="fa fa-home"></i> Inicio</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-calendar"></i> Calendario
                                <strong>Leyenda : </strong>
                                <span style="border-color:#398439;color: #449d44;"> Pagado <i class="fa fa-long-arrow-right"></i> <i class="fa fa-check-square"></i> / </span>
                                <span style="border-color:#9D0101;color: #C52929;"> Pendiente <i class="fa fa-long-arrow-right"></i> <i class="fa fa-money"></i> / </span>
                                <span style="border-color:#516BED;color: #6B51ED;"> Confirmado <i class="fa fa-long-arrow-right"></i> <i class="fa fa-circle"></i></span>
                            <div class="pull-right">
                                <a href="/calendar/add" class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Añadir
                                </a>

                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="calendar"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                @include('schedule.addCalendar')

                <script>
                    $('#calendar').fullCalendar({
                        theme: true,
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        eventClick: function (calEvent, jsEvent, view) {
                            //alert('Event: ' + calEvent.title);
                            console.log(calEvent);
                            $("#editCalendarStart").val(moment(calEvent.start._i).format('DD-MM-YYYY HH:mm'));
                            $("#editCalendarPrice").val(calEvent['price']);
                            $("#editCalendarEnd").html(moment(calEvent.end._i).format('DD-MM-YYYY HH:mm'));
                            var tim = (Date.parse(calEvent.end._i) - Date.parse(calEvent.start._i)) / 1000;

                            $('#editCalendarDuration').children('option[value="' + tim + '"]').attr('selected', 'selected');
                            $("#editCalendarDelete").attr('schedule_id', calEvent.schedule_id).attr('payment_id', calEvent.payment_id);
                            $("#editCalendarPending").attr('schedule_id', calEvent.schedule_id).attr('payment_id', calEvent.payment_id);
                            $("#editCalendarConfirm").attr('schedule_id', calEvent.schedule_id).attr('payment_id', calEvent.payment_id);
                            $("#editCalendar").attr('event-id', calEvent._id);
                            $.ajax({
                                url: '/schedule/show',
                                data: {id: calEvent.schedule_id},
                                type: 'POST',
                                success: function (data) {
                                    data = JSON.parse(data);
                                    $("#EditCalendarTherapist").html(data.therapist.name);
                                    $("#EditCalendarTherapist").attr('data-id', data.therapist.id);
                                    $("#EditCalendarPatient").html(data.patient.name);
                                    $("#EditCalendarPatientPhone").html(data.patient.cellphone+' '+data.patient.phone);
                                    $("#EditCalendarPatientMail").html(data.patient.mail);
                                    $("#EditCalendarPatient").attr('data-id', data.patient.id);
                                }
                            });
                            $.ajax({
                                url: '/payment/show',
                                data: {id: calEvent.payment_id},
                                type: 'POST',
                                success: function (data) {
                                    if (data.payment_types_id == "1" || data.payment_types_id== "2" || data.payment_types_id == "5") {
                                        display('editCalendarTransactionNumber', 'none');
                                        display('editCalendarCheckNumber', 'none');
                                        display('editCalendarPaymentDate', 'none');
                                        display('editCalendarBanks', 'none');
                                    }
                                    if (data.payment_types_id == "4") {
                                        display('editCalendarTransactionNumber', '');
                                        display('editCalendarCheckNumber', 'none');
                                        display('editCalendarPaymentDate', 'none');
                                        display('editCalendarBanks', 'none');
                                    }
                                    if (data.payment_types_id == "3") {
                                        display('editCalendarTransactionNumber', 'none');
                                        display('editCalendarCheckNumber', '');
                                        display('editCalendarPaymentDate', '');
                                        display('editCalendarBanks', '');
                                    }

                                    $("#editCalendarPaymentType").val(data.payment_types_id);
                                    $("#editCalendarTransactionNumber").val(data.transaction_number);
                                    $("#editCalendarCheckNumber").val(data.paycheck_number);
                                    $("#editCalendarPaymentDate").val(moment(data.paycheck_date,'YYYY-MM-DD').format('DD-MM-YYYY'));
                                    if(data.banks_id != 0)
                                    $("#editCalendarBanks").val(data.banks_id);
                                }
                            });
                            var status = calEvent['status'];
                            if(status == 0){
                                $("#editCalendarDelete").removeAttr('disabled');
                                $("#editCalendarPending").css('display','none');
                                $("#editCalendarConfirm").attr('style','');
                                $("#editCalendarConfirm").attr('status',1);
                            }
                            if(status == 1){
                                $("#editCalendarDelete").removeAttr('disabled');
                                $("#editCalendarPending").attr('style','');
                                $("#editCalendarConfirm").attr('style','');
                                $("#editCalendarConfirm").attr('status',3);
                                $("#editCalendarConfirm").html('Pagar Ahora!')
                            }
                            if(status == 2){
                                $("#editCalendarDelete").attr('disabled','disabled');
                                $("#editCalendarPending").css('display','none');
                                $("#editCalendarConfirm").attr('style','');
                                $("#editCalendarConfirm").attr('status',3);
                                $("#editCalendarConfirm").html('Pagar Ahora!')
                            }
                            if(status == 3){
                                $("#editCalendarDelete").attr('disabled','disabled');
                                $("#editCalendarPending").css('display','none');
                                $("#editCalendarConfirm").css('display','none');
                            }

                            $("#editCalendar").modal('show');
                        },
                        defaultView: 'agendaWeek',
                        allDaySlot: false,
                        slotDuration: '00:15:00',
                        scrollTime: '07:00:00',
                        weekends: true,
                        defaultDate: new Date(),
                        timeFormat: 'H:mm',
                        editable: false,
                        eventLimit: true, // allow "more" link when too many events
                        events: {{json_encode($datos)}}
                    });
                </script>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="color: red;">
                            <i class="fa fa-money"></i> Pagos Pendientes (MOROSOS) <small>Mas Recientes</small>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                @foreach($pendings as $pending)
                                    <a href="#/patients/{{$pending->id}}" class="list-group-item"  style="color: red;">
                                        <i class="fa fa-user"></i> {{$pending->name}}
                                        <span class="pull-right small"><em><strong>{{$pending->mount}}</strong></em>
                                    </span>
                                    </a>
                                @endforeach
                            </div>
                            <!-- /.list-group -->
                            <a href="/finance/patients" class="btn btn-default btn-block">Ver Todos los Pagos Pendientes</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editCalendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" event-id="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editCalendarLabel">Comfirmar Asistencia</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Especialista</strong></td>
                            <td id="EditCalendarTherapist"></td>
                        </tr>
                        <tr>
                            <td><strong>Paciente</strong></td>
                            <td id="EditCalendarPatient"></td>
                        </tr>
                        <tr>
                            <td><strong>Telefono Paciente</strong></td>
                            <td id="EditCalendarPatientPhone"></td>
                        </tr>
                        <tr>
                            <td><strong>Correo Paciente</strong></td>
                            <td id="EditCalendarPatientMail"></td>
                        </tr>
                        <tr>
                            <td><strong>Hora de Inicio</strong></td>
                            <td><input type="text" class="form-control" id="editCalendarStart"></td>
                        </tr>
                        <tr>
                            <td><strong>Hora de Termino</strong></td>
                            <td id="editCalendarEnd"></td>
                        </tr>
                        <tr>
                            <td><strong>Duracion</strong></td>
                            <td>
                                <select id="editCalendarDuration" class="form-control">
                                    @foreach($durations as $duration)
                                        <option value="{{$duration->timestamp}}">{{$duration->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Numero de Boleta</strong></td>
                            <td><input type="text" id="editCalendarTicketNumber" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><strong>Precio</strong></td>
                            <td><input type="text" class="form-control" id="editCalendarPrice"></td>
                        </tr>
                        <tr>
                            <td><strong>Metodo de Pago</strong></td>
                            <td><select id="editCalendarPaymentType" class="form-control">
                                    <option value="0">Seleccione Metodo de Pago</option>
                                    @foreach($paymentTypes as $paymentType)
                                        <option value="{{$paymentType->id}}">{{$paymentType->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <td><strong>Numero de Transaccion</strong></td>
                            <td><input type="text" id="editCalendarTransactionNumber" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><strong>Numero de Cheque</strong></td>
                            <td><input type="text" id="editCalendarCheckNumber" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de Vencimiento</strong></td>
                            <td><input type="text" id="editCalendarPaymentDate" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><strong>Banco</strong></td>
                            <td><select id="editCalendarBanks" class="form-control">
                                    <option value="0">Seleccion Banco</option>
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="editCalendarDelete"
                            data-toggle="tooltip" data-placement="top" title="Elimina la Hora">
                        Eliminar
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="exitButton">Salir</button>

                    <button type="button" class="btn btn-danger" id="editCalendarPending" status="2">Pago Pendiente</button>

                    <button type="button" class="btn btn-success" id="editCalendarConfirm" data-toggle="tooltip"
                            data-placement="top" title="Confirma la asistencia." status="1">Confirmar
                        Asistencia
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function display(id, view) {
            $("#" + id + "").parent().parent().css('display', view);
        }
        $("#editCalendarDuration").change(function () {
            $("#editCalendarEnd").html(moment($("#editCalendarStart").val(), 'DD-MM-YYYY HH:mm').add(parseFloat($(this).val()),'s').format('DD-MM-YYYY HH:mm'));
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            display('editCalendarTransactionNumber', 'none');
            display('editCalendarCheckNumber', 'none');
            display('editCalendarCheckNumber', 'none');
            display('editCalendarPaymentDate', 'none');
            display('editCalendarBanks', 'none');
            $('#editCalendarStart').datetimepicker({
                useCurrent: true,
                stepping: 15,
                format: 'DD-MM-YYYY HH:mm',
                locale: 'es',
                viewMode: 'days',
                sideBySide: true
            }).on('dp.change', function () {
                var end = Date.parse($("#editCalendarStart").val()) + parseInt($("#editCalendarDuration").val()) * 1000;
                $("#editCalendarEnd").html(moment(end).format('DD-MM-YYYY HH:mm'));
            });
            $('#editCalendarPaymentDate').datetimepicker({
                format: 'DD-MM-YYYY',
                locale: 'es',
                viewMode: 'months',
                minDate: moment()
            });
            $("#editCalendarPaymentType").change(function () {
                if ($(this).val() == "1" || $(this).val() == "2" || $(this).val() == "5") {
                    display('editCalendarTransactionNumber', 'none');
                    display('editCalendarCheckNumber', 'none');
                    display('editCalendarPaymentDate', 'none');
                    display('editCalendarBanks', 'none');
                }
                if ($(this).val() == "4") {
                    display('editCalendarTransactionNumber', '');
                    display('editCalendarCheckNumber', 'none');
                    display('editCalendarPaymentDate', 'none');
                    display('editCalendarBanks', 'none');
                }
                if ($(this).val() == "3") {
                    display('editCalendarTransactionNumber', 'none');
                    display('editCalendarCheckNumber', '');
                    display('editCalendarPaymentDate', '');
                    display('editCalendarBanks', '');
                }
            });
            $("#editCalendarDelete").click(function () {
                swal({
                    title: "Se encuentra Seguro?",
                    text: "Esta Accion no tiene vuelta Atras!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "si, Borrar Hora!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: '/schedule/delete',
                        type: 'POST',
                        data: {
                            schedule_id: $("#editCalendarDelete").attr('schedule_id'),
                            payment_id: $("#editCalendarDelete").attr('payment_id')
                        },
                        success: function () {
                            $("#editCalendar").modal('hide');
                            $("#calendar").fullCalendar('removeEvents', $("#editCalendar").attr('event-id'))
                        }
                    });
                    swal("Borrado!", "La Hora Seleccionada ha sido borrada.", "success");
                });
            });

            $("#editCalendarConfirm").click(function () {
               var start =  moment($("#editCalendarStart").val(), 'DD-MM-YYYY HH:mm').format("YYYY-MM-DD HH:mm:ss");
               var end =  moment($("#editCalendarEnd").html(), 'DD-MM-YYYY HH:mm').format("YYYY-MM-DD HH:mm:ss");
               var payment = moment($("#editCalendarPaymentDate").val(),'DD-MM-YYYY').format('YYYY-MM-DD');
                if($("#editCalendarPrice").val() != 0 && $("#editCalendarPrice").val() != ''){
                    if($("#editCalendarConfirm").attr('status') == 3){
                        if($("#editCalendarPaymentType").val() == 0)
                            sweetAlert("Oops...", "Falta Agregar el Tipo de Pago", "warning");
                        else{
                            if($("#editCalendarPaymentType").val() == 5)
                                sweetAlert("Oops...", "El tipo de Pago no Puede Ser Pendiente", "warning");
                            else {
                                if($("#editCalendarPaymentType").val() == 2 || $("#editCalendarPaymentType").val() == 1){
                                    if($("#editCalendarTicketNumber").val() != ""){
                                        $.ajax({
                                            url: '/schedule/confirm',
                                            type: 'POST',
                                            data: {
                                                schedule_id: $("#editCalendarConfirm").attr('schedule_id'),
                                                payment_id: $("#editCalendarConfirm").attr('payment_id'),
                                                start: start,
                                                end: end,
                                                ticket:$("#editCalendarTicketNumber").val(),
                                                price: $("#editCalendarPrice").val(),
                                                payType: $("#editCalendarPaymentType").val(),
                                                transactionNumber: $("#editCalendarTransactionNumber").val(),
                                                checkNumber: $("#editCalendarCheckNumber").val(),
                                                paymentDate: payment,
                                                bank: $("#editCalendarBanks").val(),
                                                status: $("#editCalendarConfirm").attr('status')
                                            },
                                            success: function () {
                                                var hour = $("#calendar").fullCalendar('clientEvents', $("#editCalendar").attr('event-id'))[0];
                                                if($("#editCalendarConfirm").attr('status') == 3){
                                                    hour.className = 'fa fa-check-square';
                                                }
                                                if($("#editCalendarConfirm").attr('status') == 1) {
                                                    hour.className = 'fa fa-circle';
                                                }
                                                hour.status = $("#editCalendarConfirm").attr('status');
                                                hour.price = $("#editCalendarPrice").val();
                                                $('#calendar').fullCalendar('updateEvent', hour);
                                                $("#editCalendar").modal('hide');
                                            }
                                        });
                                    }
                                    else{
                                        sweetAlert("Oops...", "El numero de Boleta no puede se vacio", "warning");
                                    }

                                }
                                if($("#editCalendarPaymentType").val() == 3){
                                    if($("#editCalendarCheckNumber").val() != 0 && $("#editCalendarCheckNumber").val() != ''){
                                        if($("#editCalendarPaymentDate").val() != ''){
                                            if($("#editCalendarBanks").val() != 0){
                                                if($("#editCalendarTicketNumber").val() != ""){
                                                $.ajax({
                                                    url: '/schedule/confirm',
                                                    type: 'POST',
                                                    data: {
                                                        schedule_id: $("#editCalendarConfirm").attr('schedule_id'),
                                                        payment_id: $("#editCalendarConfirm").attr('payment_id'),
                                                        start: start,
                                                        end: end,
                                                        ticket:$("#editCalendarTicketNumber").val(),
                                                        price: $("#editCalendarPrice").val(),
                                                        payType: $("#editCalendarPaymentType").val(),
                                                        transactionNumber: $("#editCalendarTransactionNumber").val(),
                                                        checkNumber: $("#editCalendarCheckNumber").val(),
                                                        paymentDate: payment,
                                                        bank: $("#editCalendarBanks").val(),
                                                        status: $("#editCalendarConfirm").attr('status')
                                                    },
                                                    success: function () {
                                                        var hour = $("#calendar").fullCalendar('clientEvents', $("#editCalendar").attr('event-id'))[0];
                                                        if($("#editCalendarConfirm").attr('status') == 3){
                                                            hour.className = 'fa fa-check-square';
                                                        }
                                                        if($("#editCalendarConfirm").attr('status') == 1) {
                                                            hour.className = 'fa fa-circle';
                                                        }
                                                        hour.status = $("#editCalendarConfirm").attr('status');
                                                        hour.price = $("#editCalendarPrice").val();
                                                        $('#calendar').fullCalendar('updateEvent', hour);
                                                        $("#editCalendar").modal('hide');
                                                    }
                                                });
                                                }
                                                else{
                                                    sweetAlert("Oops...", "El numero de Boleta no puede se vacio", "warning");
                                                }
                                            }else{
                                                sweetAlert("Oops...", "Falta Completar el Banco", "warning");
                                            }
                                        }else{
                                            sweetAlert("Oops...", "Falta Completar la Fecha de Vencimiento", "warning");
                                        }
                                    }else{
                                        sweetAlert("Oops...", "Falta Completar el Numero de Cheque", "warning");
                                    }

                                }
                                if($("#editCalendarPaymentType").val() == 4) {
                                    if($("#editCalendarTransactionNumber").val() != '' && $("#editCalendarTransactionNumber").val() != 0){
                                        $.ajax({
                                            url: '/schedule/confirm',
                                            type: 'POST',
                                            data: {
                                                schedule_id: $("#editCalendarConfirm").attr('schedule_id'),
                                                payment_id: $("#editCalendarConfirm").attr('payment_id'),
                                                start: start,
                                                end: end,
                                                ticket:$("#editCalendarTicketNumber").val(),
                                                price: $("#editCalendarPrice").val(),
                                                payType: $("#editCalendarPaymentType").val(),
                                                transactionNumber: $("#editCalendarTransactionNumber").val(),
                                                checkNumber: $("#editCalendarCheckNumber").val(),
                                                paymentDate: payment,
                                                bank: $("#editCalendarBanks").val(),
                                                status: $("#editCalendarConfirm").attr('status')
                                            },
                                            success: function () {
                                                var hour = $("#calendar").fullCalendar('clientEvents', $("#editCalendar").attr('event-id'))[0];
                                                    hour.className = 'fa fa-check-square';
                                                hour.status = $("#editCalendarConfirm").attr('status');
                                                $('#calendar').fullCalendar('updateEvent', hour);
                                                $("#editCalendar").modal('hide');
                                            }
                                        });
                                    }else{
                                        sweetAlert("Oops...", "El numero de Transferencia no Puede ser Vacio", "warning");
                                    }
                                }
                            }
                        }
                    }else{
                        $.ajax({
                            url: '/schedule/confirm',
                            type: 'POST',
                            data: {
                                schedule_id: $("#editCalendarConfirm").attr('schedule_id'),
                                payment_id: $("#editCalendarConfirm").attr('payment_id'),
                                start:start,
                                end: end,
                                ticket:$("#editCalendarTicketNumber").val(),
                                price:$("#editCalendarPrice").val(),
                                payType:$("#editCalendarPaymentType").val(),
                                transactionNumber: $("#editCalendarTransactionNumber").val(),
                                checkNumber:$("#editCalendarCheckNumber").val(),
                                paymentDate:payment,
                                bank:$("#editCalendarBanks").val(),
                                status:$("#editCalendarConfirm").attr('status')
                            },
                            success: function () {
                                var hour = $("#calendar").fullCalendar('clientEvents', $("#editCalendar").attr('event-id'))[0];
                                hour.className = 'fa fa-circle';
                                hour.price = $("#editCalendarPrice").val();
                                hour.status = $("#editCalendarConfirm").attr('status');
                                $('#calendar').fullCalendar('updateEvent', hour);
                                $("#editCalendar").modal('hide');
                            }
                        });
                    }

                }
                else{
                    sweetAlert("Oops...", "El Precio no puede estar vacio", "warning");
                }

                });

            $("#editCalendarPending").click(function () {
                var start =  moment($("#editCalendarStart").val(), 'DD-MM-YYYY HH:mm').format("YYYY-MM-DD HH:mm:ss");
                var end =  moment($("#editCalendarEnd").html(), 'DD-MM-YYYY HH:mm').format("YYYY-MM-DD HH:mm:ss");
                var payment = moment($("#editCalendarPaymentDate").val(),'DD-MM-YYYY').format('YYYY-MM-DD');
                swal({
                    title: "Se encuentra Seguro?",
                    text: "El pago se marcara como pendiente y no se podra Eliminar.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirmar!",
                    closeOnConfirm: true
                }, function () {
                    $.ajax({
                        url: '/schedule/confirm',
                        type: 'POST',
                        data: {
                            schedule_id: $("#editCalendarConfirm").attr('schedule_id'),
                            payment_id: $("#editCalendarConfirm").attr('payment_id'),
                            start:start,
                            end: end,
                            ticket:$("#editCalendarTicketNumber").val(),
                            price:$("#editCalendarPrice").val(),
                            payType:$("#editCalendarPaymentType").val(),
                            transactionNumber: $("#editCalendarTransactionNumber").val(),
                            checkNumber:$("#editCalendarCheckNumber").val(),
                            paymentDate:payment,
                            bank:$("#editCalendarBanks").val(),
                            status:$("#editCalendarPending").attr('status')
                        },
                        success: function () {
                            var hour = $("#calendar").fullCalendar('clientEvents', $("#editCalendar").attr('event-id'))[0];
                            hour.borderColor = '#9D0101';
                            hour.backgroundColor = '#C52929';
                            hour.textColor = '#FFFFFF';
                            hour.className = 'fa fa-money';
                            hour.price = $("#editCalendarPrice").val();
                            hour.status = $("#editCalendarConfirm").attr('status');
                            $('#calendar').fullCalendar('updateEvent', hour);
                            $("#editCalendar").modal('hide');
                        }
                    });

                });
            });
        });
    </script>
    <!-- /#wrapper -->

@stop