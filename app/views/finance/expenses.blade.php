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
                    <h1 class="page-header">Gastos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="row">
                    @if(isset($expenses))
                        <table class="table table-striped table-bordered" id="expenses">
                            <thead style="background-color: white;position: relative;">
                            <tr>
                                <th>Monto</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; ?>
                            @foreach($expenses as $expense)

                                <tr>
                                    <td>{{$expense->mount}}</td>
                                    <?php $total=$total+$expense->mount; ?>
                                    <td>{{$expense->description}}</td>
                                    <td>{{$expense->created_at}}</td>
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
                        $('#expenses').DataTable({
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                            }
                        });
                    });
                </script>
            </div>
    </div>
    <!-- /#wrapper -->

@stop