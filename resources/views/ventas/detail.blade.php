@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card" style="background-color:rgba(255,255,255,0.95);">
                <div class="card-header color-header" style="background-color: #343a40;">
                    <h5 class="text-white" style="font-weight: bold;"> {!!trans('Detalle de ventas') !!}</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="id_proveedor">{!! trans('N° de venta') !!}</label>
                            <p>{{$consult->id}}</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_proveedor">{!! trans('Fecha de venta') !!}</label>
                            <p>{{$consult->created_at}}</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{!! trans('Cliente') !!}</label>
                            <p>{{$consult->cliente->nombre}}</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{!! trans('Vendedor') !!}</label>
                            <p>{{$consult->vendedor->nombre}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="card-body table-responsive" style="overflow-x: auto;white-space: nowrap;">
                            <table id="tabledata" class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 3%">#</th>
                                        <th style="width: 32%">{!! trans('Producto') !!}</th>
                                        <th style="width: 20%">{!! trans('Cantidad') !!}</th>
                                        <th style="width: 20%">{!! trans('Valor Unidad') !!}</th>
                                        <th style="width: 25%">{!! trans('Total') !!}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($consult->detalle) > 0)
                                        @foreach($consult->detalle as $key => $item)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$item->producto->nombre}}</td>
                                                <td style="text-align: right">{{$item->cantidad_venta}}</td>
                                                <td style="text-align: right">{{number_format ($item->precio_venta_producto,2)}}</td>
                                                <td style="text-align: right">{{number_format ($item->precio_venta_total,2)}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col-md-9">
                           <label for="obs">{!! trans('Observaciones') !!}</label>
                           <textarea class="form-control form-control-sm" name="obs_compra" id="obs_compra" cols="30" rows="3" disabled>{{$consult->observaciones}}</textarea>
                       </div>
                       <div class="col-md-3"><br>
                            <label for="obs">{!! trans('Total') !!}</label>
                            <div style="text-align: right"><b>{{number_format ($consult->total_venta,2)}}</b></div>     
                        </div>
                    </div>      
                </div>
                <div class="card-body table-responsive">
                    
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm float-right">{!! trans('Regresar') !!}</a>
                    
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
