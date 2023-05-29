@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card" style="background-color:rgba(255,255,255,0.95);">
                <div class="card-header color-header" style="background-color: #343a40;">
                    <h5 class="text-white" style="font-weight: bold;"> {!!trans('Reporte de ventas') !!}</h5>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{route('reportes.ventas.search')}}">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="fecha_ini">{!! trans('Fecha inicio') !!}</label>
                                <input type="date" class="form-control form-control-sm" id="" name="fecha_ini" value="{{$olddata['fecha_ini'] ?? (new DateTime('first day of this month'))->format('Y-m-d') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fecha_fin">{!! trans('Fecha fin') !!}</label>
                                <input type="date" class="form-control form-control-sm" id="" name="fecha_fin" value="{{$olddata['fecha_fin'] ?? (new DateTime())->format('Y-m-d') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="id_cliente">{!! trans('Cliente') !!}</label>
                                <select  class="form-control form-control-sm" name="id_cliente" id="id_cliente">
                                    <option value="" {{ (($olddata['id_cliente'] ?? '' ) == '') ? 'selected' : '' }}>{!! trans('Todos') !!}...</option>               
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}" {{ (($olddata['id_cliente'] ?? '' ) == $cliente->id) ? 'selected' : '' }}>{{$cliente->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="id_usuario">{!! trans('Responsable') !!}</label>
                                <select  class="form-control form-control-sm" name="id_usuario" id="id_usuario">
                                    <option value="" {{ (($olddata['id_usuario'] ?? '' ) == '') ? 'selected' : '' }}>{!! trans('Todos') !!}...</option>               
                                    @foreach($usuarios as $usuario)
                                        <option value="{{$usuario->id}}" {{ (($olddata['id_usuario'] ?? '' ) == $usuario->id) ? 'selected' : '' }}>{{$usuario->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" name="button" value="Consultar" class="btn btn-primary btn-sm">{!!trans('Consultar') !!}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table class="table table-bordered" id="tblSuministros">
                        <thead class="thead-light">
                            <tr>
                                <th>{!! trans('#') !!}</th>
                                <th>{!! trans('Fecha') !!}</th>
                                <th>{!! trans('Valor') !!}</th>
                                <th>{!! trans('Responsable compra') !!}</th>
                                <th>{!! trans('Cliente') !!}</th>
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
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
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
