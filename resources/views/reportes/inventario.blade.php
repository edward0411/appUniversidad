@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card" style="background-color:rgba(255,255,255,0.95);">
                <div class="card-header color-header" style="background-color: #343a40;">
                    <h5 class="text-white" style="font-weight: bold;"> {!!trans('Reporte de inventario') !!}</h5>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="card-body table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table id="tabledata" class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{!! trans('#') !!}</th>
                                        <th>{!! trans('Categoria') !!}</th>
                                        <th>{!! trans('Nombre') !!}</th>
                                        <th>{!! trans('Saldo inicial') !!}</th>
                                        <th>{!! trans('Compras') !!}</th>
                                        <th>{!! trans('Ventas') !!}</th>
                                        <th>{!! trans('Saldo Actual') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($arrayReportDetalle))
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($arrayReportDetalle as $item)
                                            @php
                                                $saldo_i = abs($item['Saldo inicial de inventario'] ?? 0);
                                                $compras = abs($item['compras'] ?? 0);
                                                $ventas  = abs($item['ventas'] ?? 0);
                                                $saldo_f = $saldo_i+$compras-$ventas;
                                            @endphp
                                            <tr class="thead-light">
                                                <td><p>{{$i}}</p></td> 
                                                <td><p>{{$item['categoria']}}</p></td>
                                                <td><p>{{$item['nombre']}}</p></td>
                                                <td><p>{{$saldo_i}}</p></td>
                                                <td><p>{{$compras}}</p></td>
                                                <td><p>{{$ventas}}</p></td>
                                                <td><p>{{$saldo_f}}</p></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">                   
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm float-right">{!! trans('Regresar') !!}</a>                   
                </div>
            </div>
            <!-- /.card-->
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
</div>
<!-- /.container-->
@endsection
