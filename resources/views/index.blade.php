@extends('layouts.app')
@section('title','Home')

@section('content')


<div class="container-fluid">
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header" style="background-color:#191336 !important; color:#fff !important">
          <h2 class="card-title">Inicio</h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>$ {{number_format($consult[0]->valor,0)}}</h3>
                <p>Ventas hoy</p>
              </div>
              <div class="icon">
                <i class="icofont-coins"></i>
              </div>
              <a href="{{route('ventas.index')}}" class="small-box-footer">ver ventas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>$ {{number_format($consult[1]->valor,0)}}</h3>

                <p>Compras hoy</p>
              </div>
              <div class="icon">
                <i class="icofont-tags"></i>
              </div>
              <a href="{{route('compras.index')}}" class="small-box-footer" style="color:#fff !important">ver compras <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ number_format($consult[0]->valor - $consult[1]->valor,2)}}</h3>

                <p>Ganancias de hoy</p>
              </div>
              <div class="icon">
                <i class="icofont-tasks"></i>
              </div>
              <a href="{{route('reportes.inventario')}}" class="small-box-footer" style="color:#fff !important">ver inventario <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>


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
