@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card" style="background-color:rgba(255,255,255,0.95);">
                <div class="card-header color-header" style="background-color: #343a40;">
                    <h5 class="text-white" style="font-weight: bold;"> {!!trans('Ventas') !!}</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="card-body table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table id="tabledata" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="thead-light">
                                        <th>{!! trans('#') !!}</th>
                                        <th>{!! trans('Fecha') !!}</th>
                                        <th>{!! trans('Valor') !!}</th>
                                        <th>{!! trans('Vendedor') !!}</th>
                                        <th>{!! trans('Cliente') !!}</th>
                                        <th>{!! trans('Acciones') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($consult))
                                        @foreach($consult as $item)
                                        <tr class="thead-light">
                                            <td><p>{{$item->id}}</p></td> 
                                            <td><p>{{$item->created_at}}</p></td> 
                                            <td><p>$ {{number_format($item->total_venta,0)}}</p></td> 
                                            <td><p>{{$item->vendedor->nombre}}</p></td> 
                                            <td><p>{{$item->cliente->nombre}}</p></td> 
                                            <td>
                                                <a href="{{route('ventas.detalle',$item->id)}}" class="btn btn-warning btn-xs"><i class="fas fa-eye"></i>Ver</a>
                                            </td> 
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-->
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
</div>
<!-- /.container-->
@endsection
