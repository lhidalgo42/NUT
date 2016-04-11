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
                    <h1 class="page-header">Pagos Pendientes (MOROSOS) <small>Listado Completo</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @if(isset($payments))
                    <table class="table table-striped table-bordered" id="income">
                        <thead style="background-color: white;position: relative;">
                        <tr>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>Terapeuta</th>
                            <th>Fecha</th>
                            <th>Info</th>
                            <th>/</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0; ?>
                        @foreach($payments as $payment)

                            <tr>
                                <td>{{$payment->patient}}</td>
                                <td>{{$payment->mount}}</td>
                                <td style="text-align: center;"><a href="/therapists/{{$payment->therapist_id}}">{{$payment->therapist}}</a></td>
                                <?php $total=$total+$payment->mount; ?>
                                <td>{{$payment->end}}</td>
                                <td style="text-align: center;"><a href="#" patient-id="{{$payment->patient_id}}"><i class="fa fa-2x fa-question-circle"></i> </a></td>
                                <td style="text-align: center;"><a href="#" class="btn btn-info" patient-id="{{$payment->id}}">Pagar</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="row">
                <table>
                    <th>Total Periodo</th></tr>
                    <tr><td>{{$total}}</td>
                    </tr>

                </table>
            </div>
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

                            <button type="button" class="btn btn-success" id="editCalendarConfirm" data-toggle="tooltip"
                                    data-placement="top" title="Confirma la asistencia." status="3">Pagar AHora
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("#income > tbody > tr > td").last().children().click(function () {
                    $("#editCalendar").modal("show");
                });
                $(document).ready(function () {
                    $('#income').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                        }
                    });
                });
                function display(id, view) {
                    $("#" + id + "").parent().parent().css('display', view);
                }
                $("#editCalendarDuration").change(function () {
                    $("#editCalendarEnd").html(moment($("#editCalendarStart").val(), 'DD-MM-YYYY HH:mm').add(parseFloat($(this).val()),'s').format('DD-MM-YYYY HH:mm'));
                });
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
                                                    hour.className = 'fa fa-circle';
                                                    hour.price = $("#editCalendarPrice").val();
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
                $("#editCalendarDelete").attr('disabled','disabled');
                $("#editCalendarPending").css('display','none');
                $("#editCalendarConfirm").attr('style','');
                $("#editCalendarConfirm").attr('status',3);
                $("#editCalendarConfirm").html('Pagar Ahora!')
            </script>
        </div>
        <!-- /#wrapper -->
    </div>

@stop