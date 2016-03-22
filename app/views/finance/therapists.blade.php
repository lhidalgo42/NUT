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
                    <h1 class="page-header">Pagos Pendientes (Terapeutas)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="row">
                    @if(isset($therapists))
                        <table class="table table-striped table-bordered" id="therapist">
                            <thead style="background-color: white;position: relative;">
                            <tr>
                                <th>Nombre</th>
                                <th>Monto</th>
                                <th>/</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; ?>
                            @foreach($therapists as $therapist)
                                <tr>
                                    <td>{{$therapist->name}}</td>
                                    <td  style="text-align: center;">{{$therapist->mount}}</td>
                                    <?php $total=$total+$therapist->mount; ?>
                                    <td style="text-align: center;"><a href="#" class="btn btn-info"  therapist-id="{{$therapist->id}}" mount="{{$therapist->mount}}"> Pagar</a></td>
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
                        var table = $('#therapist').DataTable({
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
                            }
                        });
                        $('#therapist').children('tbody').children('tr').children('td').children('a').click(function(){
                            $.ajax({
                                url:'/finance/therapist/pay',
                                type:'POST',
                                data:{
                                    id:$(this).attr('therapist-id'),
                                    mount:$(this).attr('mount')
                                },
                                success:function(data){
                                    if(data == 1){
                                        alert('Pago Exitoso')
                                    }
                                }
                            })
                        })

                    });
                </script>
            </div>
            <!-- /#wrapper -->
        </div>

@stop