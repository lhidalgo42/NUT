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
                    <h1 class="page-header"><i class="fa fa-history"></i> Historial</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                @if(isset($history))
                    <table class="table table-bordered" id="history">
                        <thead>
                        <th>Nombre</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>/</th>
                        </thead>
                        <tbody>
                        @foreach($history as $item)
                            @if($item->status == 2)
                                <?php $color = 'red'; ?>
                            @elseif($item->paid == 1)
                                <?php $color = 'blue'; ?>
                            @else
                                <?php $color = 'black'; ?>
                            @endif    
                            <tr style="color: {{$color}};">
                                <td>{{$item->name}}</td>
                                <td>{{$item->mount}}</td>
                                <td>{{$item->end}}</td>
                                <td style="text-align: center;"><a href="#"  patient-id="{{$item->id}}"><i class="fa fa-question-circle fa-2x"></i> </a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#history').DataTable({
                                "language": {
                                    "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                                }
                            });
                        });
                    </script>
                @endif
            </div>

        </div>
    </div>
@stop