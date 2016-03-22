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
                    <h1 class="page-header">Ingresos</h1>
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
                            <th>Fecha</th>
                            <th>/</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0; ?>
                        @foreach($payments as $payment)

                        <tr>
                            <td>{{$payment->name}}</td>
                            <td>{{$payment->mount}}</td>
                            <?php $total=$total+$payment->mount; ?>
                            <td>{{$payment->end}}</td>
                            <td><a href="#"  patient-id="{{$payment->id}}"><i class="fa fa-2x fa-question-circle"></i> </a></td>
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
            <script>

                $(document).ready(function () {
                   $('#income').DataTable({
                        "language": {
                            "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                        }
                    });
                });
            </script>
    </div>
    <!-- /#wrapper -->
    </div>

@stop