@extends('adminlte::page')
@section('content')
@if(Auth::check() && Auth::user()->role == 'desarrollador')
<div class="panel panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Reportes</h3>
  </div>

  <div class="panel-body">
    <div class="row">
<!--
      <div class="hidden-lg hidden-md col-md-4">
        <a href="{{ route('producto.pdf') }}" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Informe de ventas mensual</i>
        </a>
      </div>

      <div class="hidden-sm hidden-xs col-md-4">
        <a href="{{ route('categoria.pdf') }}" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Informe de ventas diario</i>
        </a>
      </div>
-->
      
      <div class="hidden-sm hidden-xs col-md-4" >
        <a id="anual" name="anual" onclick=" modal()" class="btn btn-default btn-lg btn-block" style=" background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px">Venta anual</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="anual" name="anual" onclick=" modal()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta anual</i>
        </a>
      </div>

  <div class="hidden-sm hidden-xs col-md-4">
        <a id="mensual" name="mensual" onclick="reporteMensual()" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta mensual</i>
        </a>
  </div>
  <div class="hidden-lg hidden-md col-md-4">
        <a id="mensual" name="mensual" onclick="reporteMensual()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta mensual</i>
        </a>
  </div>
  <div class="hidden-sm hidden-xs col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
  </div>
  
   <div class="hidden-lg hidden-md col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
      </div>

    <div class="hidden-sm hidden-xs col-md-4" >
        <a id="listas" name="listas" onclick="lista()" class="btn btn-default btn-lg btn-block" style=" margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Listas</i>
        </a>
      </div>
       <div class="hidden-lg hidden-md col-md-4">
        <a  id="listas" name="listas" onclick="lista()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Listas</i>
        </a>
    </div>
      
      
    <div class="hidden-sm hidden-xs col-md-4" >
        <a id="eliminados" name="eliminados" onclick="eliminados()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Productos eliminados al mes</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="eliminados" name="eliminados" onclick="eliminados()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Productos eliminados al mes</i>
        </a>
      </div>

      <div class="hidden-sm hidden-xs col-md-4" >
        <a id="eliminadosDiario" name="eliminadosDiario" onclick="eliminadosDiario()" class="btn btn-default btn-lg btn-block" style=" margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Productos eliminados al día</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="eliminadosDiario" name="eliminadosDiario" onclick="eliminadosDiario()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Productos eliminados al día</i>
        </a>
      </div>

    </div>
  </div>
</div>
@elseif(Auth::check() && Auth::user()->role == 'administrador')
<div class="panel panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Reportes</h3>
  </div>

  <div class="panel-body">
    <div class="row">
<!--
      <div class="hidden-lg hidden-md col-md-4">
        <a href="{{ route('producto.pdf') }}" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Informe de ventas mensual</i>
        </a>
      </div>

      <div class="hidden-sm hidden-xs col-md-4">
        <a href="{{ route('categoria.pdf') }}" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Informe de ventas diario</i>
        </a>
      </div>
-->

      
      <div class="hidden-sm hidden-xs col-md-4" >
        <a id="anual" name="anual" onclick=" modal()" class="btn btn-default btn-lg btn-block" style=" background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px">Venta anual</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="anual" name="anual" onclick=" modal()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta anual</i>
        </a>
      </div>

  <div class="hidden-sm hidden-xs col-md-4">
        <a id="mensual" name="mensual" onclick="reporteMensual()" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta mensual</i>
        </a>
  </div>
  <div class="hidden-lg hidden-md col-md-4">
        <a id="mensual" name="mensual" onclick="reporteMensual()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta mensual</i>
        </a>
  </div>
  <div class="hidden-sm hidden-xs col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
  </div>
  
   <div class="hidden-lg hidden-md col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
      </div>

    <div class="hidden-sm hidden-xs col-md-4" >
        <a id="listas" name="listas" onclick="lista()" class="btn btn-default btn-lg btn-block" style=" margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Listas</i>
        </a>
      </div>
       <div class="hidden-lg hidden-md col-md-4">
        <a  id="listas" name="listas" onclick="lista()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Listas</i>
        </a>
    </div>
      
       <div class="hidden-sm hidden-xs col-md-4" >
        <a id="incidenciasDiarias" name="incidenciasDiarias" onclick=" incidenciasDiarias()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px">Incidencias al día</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="incidenciasDiarias" name="incidenciasDiarias" onclick=" incidenciasDiarias()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Incidencias al día</i>
        </a>
      </div>

       <div class="hidden-sm hidden-xs col-md-4" >
        <a id="incidenciasMensuales" name="incidenciasMensuales" onclick=" incidenciasMensuales()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px">Incidencias al mes</i>
        </a>
      </div>

      <div class="hidden-lg hidden-md col-md-4">
        <a  id="incidenciasMensuales" name="incidenciasMensuales" onclick=" incidenciasMensuales()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Incidencias al mes</i>
        </a>
      </div>


    </div>
  </div>
</div>



@elseif(Auth::check() && Auth::user()->role == 'cajero')
<div class="panel panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Reportes</h3>
  </div>

  <div class="panel-body">
    <div class="row">
  <div class="hidden-sm hidden-xs col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
  </div>
  
   <div class="hidden-lg hidden-md col-md-4">
        <a id="diario" name="diario" onclick="reporteDiario()" class="btn btn-default btn-lg btn-block" style="margin-top:10px; background-color: white;">
          <i class="fas fa-caret-down" style="padding-right: 5px"> Venta diario</i>
        </a>
  </div>
   </div>
   </div>
   </div>
@endif
<div id="formModal1" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title1">Reporte anual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form1" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Año</label>
                                    <div class="col-md-8">
                                       <select id="estado1" type="text" class="form-control" name="estado1" value="{{ old('estado1') }}" required>
                                       	<option id="0"  selected ="" disabled="" value="{{ old('estado1') }}">Seleccione el año</option>
                                       	 @foreach ($variable as $g)        
                                         <option value="{{$g}}">{{$g}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action1" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button" id="action_button1" class="btn btn-warning" value="Add1" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

      <div id="formModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Año</label>
                                    <div class="col-md-8">

                                       <select id="estado" type="text" class="form-control" name="estado" value="{{ old('estado_id') }}" required>
                                       	<option id="0"  selected ="" disabled="" value="{{ old('estado') }}">Seleccione el año</option>
                                       	 @foreach ($variable2 as $g)        
                                         <option value="{{$g}}">{{$g}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                       <select id="meses" type="text" class="form-control" name="meses" value="{{ old('meses_id') }}" required>
                                       <option id="0"  selected ="" disabled="" value="{{ old('estado') }}">Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="formModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title2">Reporte diario</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form2" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Mesa</label>
                                    <div class="col-md-8">
                                       <select id="estado2" type="text" class="form-control" name="estado2" value="{{ old('estado2') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado2') }}">Seleccione la mesa</option>
                                         <option value="4">Todas</option>
                                         <option value="3">Restaurante</option>
                                         <option value="2">Apps</option>
                                         <option value="1">Para llevar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="control-label col-md-2">Fecha:</label>
                                <div class="col-md-8">
                                <input type="date" class="form-control"  id="fecha" name="fecha"  required>
                                </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action2" id="action2" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button2" id="action_button2" class="btn btn-warning" value="Add2" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

  <div id="formModal3" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title3">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form3" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Año</label>
                                    <div class="col-md-8">

                                       <select id="estado3" type="text" class="form-control" name="estado3" value="{{ old('estado3') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado3') }}">Seleccione el año</option>
                                         @foreach ($variable2 as $g)        
                                         <option value="{{$g}}">{{$g}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                       <select id="meses3" type="text" class="form-control" name="meses3" value="{{ old('meses3') }}" required>
                                       <option id="0"  selected ="" disabled="" value="{{ old('meses3') }}">Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action3" id="action3" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button3" id="action_button3" class="btn btn-warning" value="Add3" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

             <div id="formModal5" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title5">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result5"></span>
                            <form method="post" id="sample_form5" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Año</label>
                                    <div class="col-md-8">

                                       <select id="estado5" type="text" class="form-control" name="estado5" value="{{ old('estado5') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado5') }}">Seleccione el año</option>
                                        @foreach ($variable3 as $g)        
                                         <option value="{{$g}}">{{$g}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                       <select id="meses5" type="text" class="form-control" name="meses5" value="{{ old('meses5') }}" required>
                                       <option id="0"  selected ="" disabled="" value="{{ old('meses5') }}">Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action5" id="action5" />
                                    <input type="hidden" name="hidden_id5" id="hidden_id5" />
                                    <input type="submit" name="action_button5" id="action_button5" class="btn btn-warning" value="Add5" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<div id="formModal4" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title4">Listas</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result4"></span>
                            <form method="post" id="sample_form4" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Listas</label>
                                    <div class="col-md-8">

                                       <select id="estado4" type="text" class="form-control" name="estado4" value="{{ old('estado4') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado4') }}">Seleccione la lista</option>
                                         <option value="1">Lista de productos</option>
                                         <option value="2">Lista de categorías</option>
                                         <option value="3">Lista de usuarios</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action4" id="action4" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button4" id="action_button4" class="btn btn-warning" value="Add4" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

      <div id="formModal6" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title6">Reporte incidencias diarias</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form6" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Tipo incidencia</label>
                                    <div class="col-md-8">

                                       <select id="tipo6" type="text" class="form-control" name="tipo6" value="{{ old('tipo6') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('tipo6') }}">Seleccione el tipo de incidencia</option>
                                         <option value="1">Mesas canceladas</option>
                                         <option value="2">Productos eliminados</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Mesa</label>
                                    <div class="col-md-8">
                                       <select id="estado6" type="text" class="form-control" name="estado6" value="{{ old('estado6') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado6') }}">Seleccione la mesa</option>
                                         <option value="4">Todas</option>
                                         <option value="3">Restaurante</option>
                                         <option value="2">Apps</option>
                                         <option value="1">Para llevar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="control-label col-md-2">Fecha:</label>
                                <div class="col-md-8">
                                <input type="date" class="form-control"  id="fecha6" name="fecha6"  required>
                                </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action6" id="action6" />
                                    <input type="hidden" name="hidden_id6" id="hidden_id6" />
                                    <input type="submit" name="action_button6" id="action_button6" class="btn btn-warning" value="Add6" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

  <div id="formModal7" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title7">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result7"></span>
                            <form method="post" id="sample_form7" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                  <div class="form-group">
                                    <label class="control-label col-md-2" >Tipo incidencia</label>
                                    <div class="col-md-8">
                                       <select id="tipo7" type="text" class="form-control" name="tipo7" value="{{ old('tipo7') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('tipo7') }}">Seleccione el tipo de incidencia</option>
                                         <option value="1">Mesas canceladas</option>
                                         <option value="2">Productos eliminados</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Año</label>
                                    <div class="col-md-8">

                                       <select id="estado7" type="text" class="form-control" name="estado7" value="{{ old('estado7') }}" required>
                                        <option id="0"  selected ="" disabled="" value="{{ old('estado7') }}">Seleccione el año</option>
                                        @foreach ($variable3 as $g)        
                                         <option value="{{$g}}">{{$g}}</option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                       <select id="meses7" type="text" class="form-control" name="meses7" value="{{ old('meses7') }}" required>
                                       <option id="0"  selected ="" disabled="" value="{{ old('meses7') }}">Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action7" id="action7" />
                                    <input type="hidden" name="hidden_id7" id="hidden_id7" />
                                    <input type="submit" name="action_button7" id="action_button7" class="btn btn-warning" value="Add7" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <div ng-repeat="reportGroup in reportGroups" ng-show="getNumReportsForGroup(reportGroup.id)>0" class="ng-scope">
            <h3 class="ng-binding">Ingresos por fecha <span class="label label-default ng-binding"></span></h3>
            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <th class="col-lg-1 hidden-xs text-center">ID</th>
                    <th class="col-lg-9 col-md-9 col-sm-9 col-xs-9">Título</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">&nbsp;</th>
                </tr>

                <tr ng-repeat="report in getReportsForGroup(reportGroup.id)" class="ng-scope">
                    <td class="col-lg-1 hidden-xs text-center ng-binding">75</td>
                    <td class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ng-binding">Ingresos por día</td>
                    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                        <button data-toggle="modal" data-target="#myModal" class="btn btn-primary with-icon" title="Abrir">
                            <i class="fas fa-cloud-download-alt" aria-hidden="true"></i>
                        </button>
                    </td>

                </tr>
            </tbody>
            </table>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informe "Ingresos por día"</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function modal(){
 $('#anual').click(function(){
            $('.modal-title1').text("Reporte anual");
            $('#action_button1').val("Seleccionar");
            $('#action1').val("Add1");
            $('#formModal1').modal('show');

        });

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});
        $('#sample_form1').on('submit', function(event){
            event.preventDefault();
            if($('#action1').val() == 'Add1')
            {
            estado= $('#estado1').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado 
           };
                $.ajax({
                    url:"/reporteAnual/"+estado,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form1')[0].reset(); 
                         $('#formModal1').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteAnual/'+estado);
            }
        });         
}

function reporteMensual(){
 $('#mensual').click(function(){
            $('.modal-title').text("Reporte mensual");
            $('#lbmeses').show();
            $('#meses').show();
            $('#action_button').val("Seleccionar");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

$('#estado').on('change', function() { 
    var estado = $('#estado').val();

    $.ajax({
      url: "meses/"+estado,
      type: "GET",
      dataType: "json",
      error: function(element){
      //console.log(element);
      }, 
      success: function(respuesta){
        $("#meses").html('<option value="" selected="true"> Seleccione el mes </option>');
        respuesta.forEach(element => {
          $('#meses').append('<option value='+element.id+'> '+element.mes+' </option>')
        });
      }
    });
});
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            estado= $('#estado').val();
            meses= $('#meses').val();

             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado,
            "meses":meses
           };
                $.ajax({
                    url:"/reporteMensual/"+estado+"/"+meses,
                    type: "GET",
                    data:$('#sample_form').serialize(),                   
                    success:function(data)
                    {
                         $('#sample_form')[0].reset(); 
                         $('#formModal').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteMensual/'+estado+'/'+meses);
            }
          
        });

}

function reporteDiario(){
$('#diario').click(function(){
            $('.modal-title2').text("Reporte diario");
            $('#action_button2').val("Seleccionar");
            $('#action2').val("Add2");
            $('#formModal2').modal('show');

        });

$('#sample_form2').on('submit', function(event){
            event.preventDefault();
            if($('#action2').val() == 'Add2')
            {
            estado= $('#estado2').val();
            fecha= $('#fecha').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado 
           };
                $.ajax({
                    url:"/reporteDiario/"+estado+'/'+fecha,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form2')[0].reset(); 
                         $('#formModal2').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteDiario/'+estado+'/'+fecha);
            }
        });     
}

function eliminados(){
$('#eliminados').click(function(){
            $('.modal-title3').text("Informe de productos eliminados al mes");
            $('#action_button3').val("Seleccionar");
            $('#action3').val("Add3");
            $('#formModal3').modal('show');
        });

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

$('#estado3').on('change', function() { 
    var estado = $('#estado3').val();

    $.ajax({
      url: "mesesEliminados/"+estado,
      type: "GET",
      dataType: "json",
      error: function(element){
      //console.log(element);
      }, 
      success: function(respuesta){
        $("#meses3").html('<option value="" selected="true"> Seleccione el mes </option>');
        respuesta.forEach(element => {
          $('#meses3').append('<option value='+element.id+'> '+element.mes+' </option>')
        });
      }
    });
});
        $('#sample_form3').on('submit', function(event){
            event.preventDefault();
            if($('#action3').val() == 'Add3')
            {
            estado= $('#estado3').val();
            meses= $('#meses3').val();

             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado,
            "meses":meses
           };
                $.ajax({
                    url:"/reporteEliminados/"+estado+"/"+meses,
                    type: "GET",
                    data:$('#sample_form3').serialize(),                   
                    success:function(data)
                    {
                         $('#sample_form3')[0].reset(); 
                         $('#formModal3').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteEliminados/'+estado+'/'+meses);
            }
          
        });

}

function eliminadosDiario(){
$('#eliminadosDiario').click(function(){
            $('.modal-title2').text("Reporte de productos eliminados al día");
            $('#action_button2').val("Seleccionar");
            $('#action2').val("Add2");
            $('#formModal2').modal('show');

        });

$('#sample_form2').on('submit', function(event){
            event.preventDefault();
            if($('#action2').val() == 'Add2')
            {
            estado= $('#estado2').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado 
           };
                $.ajax({
                    url:"/reporteDiarioEliminados/"+estado,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form2')[0].reset(); 
                         $('#formModal2').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteDiarioEliminados/'+estado);
            }
        });     
}

function lista(){
$('#listas').click(function(){
            $('.modal-title4').text("Listas");
            $('#action_button4').val("Seleccionar");
            $('#action4').val("Add4");
            $('#formModal4').modal('show');

        });

$('#sample_form4').on('submit', function(event){
            event.preventDefault();
            if($('#action4').val() == 'Add4')
            {
            estado= $('#estado4').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado 
           };
                $.ajax({
                    url:"/listas/"+estado,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form4')[0].reset(); 
                         $('#formModal4').modal('hide');  
                    }
                })
             $(location).attr('href','/listas/'+estado);
            }
        });     
}

//
function mesasEliminadas(){
$('#mesasEliminados').click(function(){
            $('.modal-title5').text("Informe de mesas canceladas al mes");
            $('#action_button5').val("Seleccionar");
            $('#action5').val("Add5");
            $('#formModal5').modal('show');
        });

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

$('#estado5').on('change', function() { 
    var estado = $('#estado5').val();

    $.ajax({
      url: "mesesEliminados/"+estado,
      type: "GET",
      dataType: "json",
      error: function(element){
      //console.log(element);
      }, 
      success: function(respuesta){
        $("#meses5").html('<option value="" selected="true"> Seleccione el mes </option>');
        respuesta.forEach(element => {
          $('#meses5').append('<option value='+element.id+'> '+element.mes+' </option>')
        });
      }
    });
});
        $('#sample_form5').on('submit', function(event){
            event.preventDefault();
            if($('#action5').val() == 'Add5')
            {
            estado= $('#estado5').val();
            meses= $('#meses5').val();

             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado,
            "meses":meses
           };
                $.ajax({
                    url:"/reporteMesasEliminadas/"+estado+"/"+meses,
                    type: "GET",
                    data:$('#sample_form5').serialize(),                   
                    success:function(data)
                    {
                         $('#sample_form5')[0].reset(); 
                         $('#formModal5').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteMesasEliminadas/'+estado+'/'+meses);
            }
          
        });

//console.log("hola");
}

function mesasEliminadasDiarias(){
$('#mesasEliminadosDiario').click(function(){
            $('.modal-title2').text("Reporte de mesas canceladas al día");
            $('#action_button2').val("Seleccionar");
            $('#action2').val("Add2");
            $('#formModal2').modal('show');

        });

$('#sample_form2').on('submit', function(event){
            event.preventDefault();
            if($('#action2').val() == 'Add2')
            {
            estado= $('#estado2').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado 
           };
                $.ajax({
                    url:"/reporteMesasDiarioEliminados/"+estado,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form2')[0].reset(); 
                         $('#formModal2').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteMesasDiarioEliminados/'+estado);
            }
        });
}

function incidenciasDiarias(){
$('#incidenciasDiarias').click(function(){
            $('.modal-title6').text("Reporte de incidencias al día");
            $('#action_button6').val("Seleccionar");
            $('#action6').val("Add6");
            $('#formModal6').modal('show');

        });

$('#sample_form6').on('submit', function(event){
            event.preventDefault();
            if($('#action6').val() == 'Add6')
            {
            estado= $('#estado6').val();
            tipo= $('#tipo6').val();
            fecha= $('#fecha6').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado,
            "tipo":tipo,
            "fecha":fecha
           };
                $.ajax({
                    url:"/reporteIncidenciasDiarias/"+estado+"/"+tipo+"/"+fecha,
                    type: "GET",
                    success:function(data)
                    {
                         $('#sample_form6')[0].reset(); 
                         $('#formModal6').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteIncidenciasDiarias/'+estado+'/'+tipo+"/"+fecha);
            }
        });
}

function incidenciasMensuales(){
$('#incidenciasMensuales').click(function(){
            $('.modal-title7').text("Reporte de incidencias al mes");
            $('#action_button7').val("Seleccionar");
            $('#action7').val("Add7");
            $('#formModal7').modal('show');
        });

$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

$('#estado7').on('change', function() { 
    
    estado= $('#estado7').val();
   
    $.ajax({
      url: "mesesEliminados/"+estado,
      type: "GET",
      dataType: "json",
      error: function(element){
      //console.log(element);
      }, 
      success: function(respuesta){
        $("#meses7").html('<option value="" selected="true"> Seleccione el mes </option>');
        respuesta.forEach(element => {
        $('#meses7').append('<option value='+element.id+'> '+element.mes+' </option>')
        });
      }
    });
});
        $('#sample_form7').on('submit', function(event){
            event.preventDefault();
            if($('#action7').val() == 'Add7')
            {
            estado= $('#estado7').val();
            tipo= $('#tipo7').val();
            meses= $('#meses7').val();
             var data ={
            "_token":$("meta[name='csrf-token']").attr("content"),
            "estado":estado,
            "tipo":tipo,
            "meses":meses
           };
                $.ajax({
                    url:"/reporteIncidenciasMensuales/"+estado+"/"+tipo+"/"+meses,
                    type: "GET",
                    data:$('#sample_form7').serialize(),                   
                    success:function(data)
                    {
                         $('#sample_form7')[0].reset(); 
                         $('#formModal7').modal('hide');  
                    }
                })
             $(location).attr('href','/reporteIncidenciasMensuales/'+estado+'/'+tipo+'/'+meses);
            }
          
        });
//console.log("hola");
}

</script>


@endsection
@section('footer')
    @include('footer')
@endsection