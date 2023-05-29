@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card" style="background-color:rgba(255,255,255,0.95);">
                <div class="card-header color-header" style="background-color: #3to43a40;">
                    <h5 class="text-white" style="font-weight: bold;"> {!!trans('Estimación de compra') !!}</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="id_categoria">{!! trans('Categorias') !!}</label>
                            <select  class="form-control form-control-sm " name="id_categoria" id="id_categoria" onchange="traerProductos()">
                                <option value="" {{ (($olddata['id_categoria'] ?? '' ) == '') ? 'selected' : '' }}>{!! trans('Seleccione') !!}...</option>               
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}" {{ (($olddata['id_categoria'] ?? '' ) == $categoria->id) ? 'selected' : '' }}>{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_proveedor">{!! trans('Productos') !!}</label>
                            <select  class="form-control form-control-sm " name="id_producto" id="id_producto">
                                
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">{!! trans('Fecha inicial consulta') !!}</label>
                            <input type="date" class="form-control form-control-sm" id="fecha_ini" name="fecha_ini" max="{{(new DateTime())->format('Y-m-d')}}" value="{{$olddata['fecha_ini'] ?? (new DateTime('first day of this month'))->format('Y-m-d') }}">
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">{!! trans('Fecha final consulta') !!}</label>
                            <input type="date" class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" max="{{(new DateTime())->format('Y-m-d')}}" value="{{$olddata['fecha_fin'] ?? (new DateTime())->format('Y-m-d') }}">
                            
                        </div>
                        <div class="form-group col-md-6">
                            <a href="#" onclick="consultData()" class="btn btn-primary btn-sm float-center">{!! trans('Consultar') !!}</a> 
                        </div>
                    </div>
                    <div class="row" style="display:none" id="div_consult">
                        <div class="form-group col-md-4">
                            <label for="id_categoria">{!! trans('Cantidad vendida') !!}</label>
                            <input type="text" name="cant_vendida" id="cant_vendida" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_proveedor">{!! trans('Valor venta') !!}</label>
                            <input type="text" style="text-align: right;" name="valor_venta" id="valor_venta" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_proveedor">{!! trans('Valor unidad') !!}</label>
                            <input type="text" style="text-align: right;" name="valor_unidad" id="valor_unidad" class="form-control form-control-sm" readonly>
                            <input type="hidden" name="valor_unidad_hidden" id="valor_unidad_hidden" >
                        </div>
                        <hr>
                        <div class="form-group col-md-4">
                            <label for="id_categoria">{!! trans('Días estimados') !!}</label>
                            <input type="number" name="dias_estimados" id="dias_estimados" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">{!! trans('Cantidad días a estimar') !!}</label>
                            <input type="number" min="1" step="0" style="text-align: right;" class="form-control form-control-sm" id="dias_estimar" name="dias_estimar" value="">
                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">{!! trans('Valor unitario de compra') !!}</label>
                            <input type="number" min="1" step="0.01" style="text-align: right;" class="form-control form-control-sm" id="unitario_compra" name="unitario_compra" value="" onchange="calcularEstimacion()">         
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="display:none" id="div_estimate">
                        
                        <div class="form-group col-md-4">
                            <label for="cant_estimada">{!! trans('Cantidad estimada de compra') !!}</label>
                            <input type="text" name="cant_estimada" id="cant_estimada" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="valor_compra_estimada">{!! trans('Valor estimada de compra') !!}</label>
                            <input type="text" name="valor_compra_estimada" id="valor_compra_estimada" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_proveedor">{!! trans('Analisis de ganancia') !!}</label>
                            <div id="analisis">

                            </div>
                            <a href="#" class="btn btn-danger btn-sm float-right" onclick="limpiar()">{!! trans('Limpiar') !!}</a> 
                        </div>
                        
                    </div>
                </div>
                
                <div class="card-body table-responsive">                  
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm float-right">{!! trans('Regresar') !!}</a>                   
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
@section('script')

<script type="text/javascript">

    const formatterPeso = new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    })

    function traerProductos(){

        var id_categoria = $('#id_categoria').val();         
        var url="{{route('estimaciones.compras.getInfoProductos')}}";
        var datos = {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        "id_categoria":id_categoria,
        };

        $.ajax({
            type: 'GET',
            url: url,
            data: datos,
            success: function(respuesta) {
                $('#id_producto').empty()
                $('#id_producto').append( $('<option></option>').val('').html('{!! trans("Seleccione...") !!}') );
                $.each(respuesta, function(index, value) {
                    $('#id_producto').append( $('<option></option>').val(value.id).html(value.nombre) );
                });
            }
        });
    }

    function consultData(){
        $('#div_consult').show();

        var id_producto = $('#id_producto').val();         
        var fecha_ini = $('#fecha_ini').val();         
        var fecha_fin = $('#fecha_fin').val();  
        let f1 = new Date(fecha_ini);
        let f2 = new Date(fecha_fin);
        var diff = f2 - f1;
        diferenciaDias = Math.floor(diff / (1000 * 60 * 60 * 24));
        
        var url="{{route('estimaciones.compras.getInfoVetasProducts')}}";
        var datos = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id_producto":id_producto,
            "fecha_ini":fecha_ini,
            "fecha_fin":fecha_fin,
        };

        $.ajax({
            type: 'GET',
            url: url,
            data: datos,
            success: function(respuesta) {
                $.each(respuesta, function(index, value) {
                    $('#cant_vendida').empty();
                    $('#valor_venta').empty();
                    $('#valor_unidad').empty();
                    $('#cant_vendida').val(value.cantidad);
                    $('#valor_venta').val(formatterPeso.format(value.venta_total));
                    $('#valor_unidad').val(formatterPeso.format(value.valor_unitario));
                    $('#valor_unidad_hidden').val(value.valor_unitario);
                    $('#dias_estimados').val(diferenciaDias+1);
                    

                });
            }
        });
    }

    function calcularEstimacion()
    {
        $('#div_estimate').show();

        var valor_unidad = $('#valor_unidad_hidden').val();         
        var cant_vendida = $('#cant_vendida').val();         
        var dias_estimados = $('#dias_estimados').val();
        var dias_estimar = $('#dias_estimar').val();
        var unitario_compra = $('#unitario_compra').val();

        var cant_estimada = (cant_vendida*dias_estimar)/dias_estimados;
        var valor_compra_estimada = unitario_compra*cant_estimada;


        var diff = valor_unidad - unitario_compra;

        var promedio = (diff * 100)/unitario_compra;


        $('#cant_estimada').val(cant_estimada);
        $('#valor_compra_estimada').val(formatterPeso.format(valor_compra_estimada));

        if (promedio > 20) {
            
            $('#analisis').html('<p> <i class="fas fa-check-circle" style="color: #00ff40;"></i> '+promedio.toFixed(2)+' % </p>');
        } else {
            $('#analisis').html('<p> <i class="fas fa-times-circle" style="color: #ff0000;"></i> '+promedio.toFixed(2)+' % </p>');
            
        }
        
    }

    function limpiar(){

        $('#id_producto').empty();         
        $('#fecha_ini').val('');         
        $('#fecha_fin').val('');  
        $('#cant_vendida').val('');         
        $('#valor_venta').val('');         
        $('#valor_unidad_hidden').val('');         
        $('#dias_estimados').val('');
        $('#dias_estimar').val('');
        $('#unitario_compra').val('');
        $('#cant_estimada').val('');
        $('#valor_compra_estimada').val('');
        $('#analisis').empty();
        $('#div_estimate').hide();
        $('#div_consult').hide();

    }

    $(document).ready(function() {
       
    });
</script>
@endsection
