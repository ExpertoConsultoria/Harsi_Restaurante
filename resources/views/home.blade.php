@extends('layouts.app')
@section('content')

    @if(Auth::check() && Auth::user()->role == 'administrador')
        <div class="container">
            <div class="row">
                <!--Mesas-->
                <div class="col-sm-3">
                    <div class="row">
                        <table id="tableUserList" class="table" style="margin-top:10px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th style="width:1%">Estado</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="mesaStatus">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Fin Mesas-->

                <div class="col-sm-9">
                    <form method="POST" action="/inicio" id="sample_venta" name="sample_venta" class="form-horizontal"
                        enctype="multipart/form-data">
                        <div class="card border-dark" style="margin-top:10px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" id="fecha" name="fecha" class="form-control"
                                                value="<?php echo date("Y-m-d");?>" required readonly="readonly"
                                                style="background-color:#FFF;cursor: no-drop;">
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mesa">Mesa</label>
                                            <input type="text" name="mesa" id="id_proveedor" class="form-control"
                                                readonly="readonly" style="background-color:#FFF;cursor: no-drop;" required="">
                                            <label for="" id="lbmesa"></label>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cajero">Atiende</label>
                                            <input readonly="readonly" style="background-color:#FFF;cursor: no-drop;"
                                                id="cajero" type="text" class="form-control" name="cajero"
                                                value="{{Auth::user()->name}}" required>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cajero">Forma de pago</label>
                                            <select class="form-control" name="forma_pago" id="forma_pago"
                                                title="Seleccione la forma de pago.">
                                                <option value="" disabled selected>Seleccionar</option>
                                            </select>
                                            <label for="" id="lbpago"></label>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <!--  Sección 2 -->
                                    @if($restaurante['hotel'] != 'No')
                                    <input type="hidden" id="rhotel" class="form-control" value="{{ $restaurante['hotel'] }}">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="habitacion">Habitación</label>
                                            <select required class="form-control" name="habitacion" id="habitacion"
                                                title="Seleccione la habitación solicitante">
                                                <option value="">Seleccionar</option>
                                            </select>
                                            <label for="" id="lbhabitacion"></label>
                                        </div>
                                    </div><!-- fin col-md-3 -->

                                    @endif

                                    <div style="display:none" class="col-md-6">
                                        <div class="form-group">
                                            <label name="turnolb" id="turno" for="turnolb">Turno</label>
                                            <input type="text" name="turno" id="turno" value="{{Auth::user()->turno}}"
                                                class="form-control">
                                            <label for="" id="lbturno"></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label name="clientelb" id="clientelb" for="clientelb">Cliente</label>
                                            <input type="text" name="cliente" id="cliente" class="form-control">
                                            <label for="" id="lbcliente"></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label name="direccionlb" id="direccionlb" for="direccionlb">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control">
                                            <label for="" id="lbdireccion"></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Comanda Productos-->
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-9">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center g-2">
                                            <!-- Seccion 1 -->
                                            @if($restaurante['subcategoria'] != 'No')

                                                <div class="col-12">
                                                    <div class="form-group mb-1" id="searchProducto">
                                                        {{-- <label for="producto">Buscador</label> --}}
                                                        <input id="product_name" value="" class="form-control"
                                                            type="text" placeholder="Buscar Producto"
                                                            data-live-search="true">
                                                    </div>

                                                    <!-- Hover added -->
                                                    <div class="list-group mb-3" id="showProducts" tabindex="1">
                                                        <div id="showProducts"></div>
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <input type="hidden" id="rsubcategoria" class="form-control"
                                                        value="{{ $restaurante['subcategoria'] }}">

                                                        <div class="row justify-content-center align-items-center g-2">

                                                            <div class="col-11">
                                                                <div class="form-group">
                                                                    <label class="mb-0" for="subcategoria">Categoría</label>
                                                                    <select id="select_categoria" name="select_categoria"
                                                                        size="4" class="form-control selectpicker"
                                                                        data-live-search="true">
                                                                        <option selected disabled>-- Selecciona --</option>
                                                                        @foreach($cta as $cta)
                                                                        <option value="{{ $cta->id }}">{{ $cta->titulo }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <div class="form-group">
                                                                    <label class="mb-0" for="subcategoria">Subcategoría</label>
                                                                    <select id="select_subcategoria" name="select_subcategoria"
                                                                        size="4" class="form-control selectpicker"
                                                                        data-live-search="true">
                                                                        <option selected disabled>-- Selecciona --</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="producto" class="mb-0">Producto</label>
                                                                <select id="producto" class="form-control selectpicker"
                                                                    data-live-search="true">
                                                                    <option value="">-- -- --</option>
                                                                </select>
                                                                <input id="pid_articulo" class="form-control user" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-0">
                                                            <div class="form-group">
                                                                <label for="pprecio_compra" class="mb-0">Precio</label>
                                                                <input id="pprecio_compra" class="form-control" type="text"
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbprecio_compra"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" style="margin-top: -1.5rem">
                                                            <label for="pcantidad" class="mb-0">Cantidad</label>
                                                            <input type="number" min="1" max="9" id="pcantidad" class="form-control"
                                                                value="1">
                                                            <label for="" id="lbcantidad"></label>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <button type="button" id="bt_add"
                                                                    class="text-center btn btn-warning">
                                                                    Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else

                                                <div class="col-12">
                                                    <div class="form-group mb-1" id="searchProducto">
                                                        {{-- <label for="producto">Buscador</label> --}}
                                                        <input id="product_name" value="" class="form-control"
                                                            type="text" placeholder="Buscar Producto"
                                                            data-live-search="true">
                                                    </div>

                                                    <!-- Hover added -->
                                                    <div class="list-group mb-3" id="showProducts" tabindex="1">
                                                        <div id="showProducts"></div>
                                                    </div>

                                                </div>

                                                <div class="col-6 pb-5">
                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <input type="hidden" id="rsubcategoria" class="form-control"
                                                            value="{{ $restaurante['subcategoria'] }}">

                                                        <div class="form-group mb-3">
                                                            <label for="select_categoria">Categoría</label>
                                                            <select id="select_categoria" name="select_categoria" size="6"
                                                                class="form-control selectpicker" data-live-search="true">
                                                                <option selected disabled>-- Selecciona una Categoría --
                                                                </option>
                                                                @foreach($cta as $cta)
                                                                <option value="{{ $cta->id }}">{{ $cta->titulo }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">

                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="producto" class="mb-0">Producto</label>
                                                                <select id="producto" class="form-control selectpicker"
                                                                    data-live-search="true">
                                                                    <option value="">-- -- --</option>
                                                                </select>
                                                                <input id="pid_articulo" style="z-index:2" class="form-control user" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-0">
                                                            <div class="form-group">
                                                                <label for="pprecio_compra" class="mb-0">Precio</label>
                                                                <input id="pprecio_compra" class="form-control" type="text"
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbprecio_compra"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" style="margin-top: -1.5rem">
                                                            <label for="pcantidad" class="mb-0">Cantidad</label>
                                                            <input type="number" min="1" max="9" id="pcantidad" class="form-control"
                                                                value="1">
                                                            <label for="" id="lbcantidad"></label>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <button type="button" id="bt_add"
                                                                    class="text-center btn btn-warning">
                                                                    Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center g-2">

                                            <!--  Sección 2 -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="mb-0" for="articulo">Producto extra</label>
                                                    <input type="text" id="pespecial" class="form-control">
                                                    <label for="" id="lbpespecial"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.5rem">
                                                <div class="form-group">
                                                    <label class="mb-0" for="pprecio_compra">Precio</label>
                                                    <input type="text" id="pesprecio" class="form-control">
                                                    <label for="" id="lbpesprecio"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.5rem">
                                                <div class="form-group">
                                                    <label class="mb-0" for="pcantidad">Cantidad</label>
                                                    <input type="number" min="1" max="9" id="pespcant" class="form-control"
                                                        value="1">
                                                    <label for="" id="lbpespcant"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.01rem">
                                                <div class="form-group text-center">
                                                    <button type="button" id="agrega" class="btn btn-warning">
                                                        Registrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--  Fin Productos -->

                        <!--Comanda Restante -->
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row">

                                            <!--  Sección comentarios -->
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label name="comentariolb" id="comentariolb"
                                                        for="comentariolb">Comentarios</label>
                                                    <input type="text" name="comentario" id="comentario" class="form-control" value="Ninguno">
                                                    <label for="" id="lbcomentario"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="margin-top:30px">
                                                <div class="form-group">
                                                    <button type="button" id="guardarComentario" class="btn btn-warning">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                            <!--  Sección 3 -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="userDescuento" name="userDescuento"
                                                        value="{{$administrador->descuento}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="motivo" name="motivo" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="valor" name="valor" class="form-control" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="incrementa" name="incrementa" class="form-control"
                                                        value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="mesa_estado" name="mesa_estado"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-md-2" style="margin-top:30px">
                                                <div class="form-group">
                                                    <button type="button" id="guardarComanda" class="btn btn-primary">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="table-responsive" style="overflow:hidden;">
                                                <table id="detalles" name="detalles" class="table table-bordered table-striped"
                                                    style="margin-top: 10px">
                                                    <thead class="table-success">
                                                        <th>Acciones</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio Compra</th>
                                                        <th>Subtotal</th>
                                                    </thead>
                                                    <tfoot>
                                                        <th id="totalEtiqueta">Subtotal</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>

                                                            {{-- Pago Form --}}

                                                                                    {{-- == 'No' --}}
                                                            @if($restaurante['reducir'] != 'Si')
                                                                <input type="hidden" id="reducir" name="reducir"
                                                                    class="form-control" value="{{$restaurante['reducir']}}">
                                                                <h1 id="total" style="margin-bottom: -1rem;">0.00</h1>
                                                                <input type="hidden" id="total1" class="m-0" name="total1">
                                                                <input id="conftotal" class="m-0" name="conf_total" type="hidden"
                                                                    placeholder="Confirma el importe" style="" autocomplete="off" required>
                                                                <label for="" id="lbconf_total"></label>


                                                                <input id="desc" class="form-control" name="descuento" onchange="calcular()"
                                                                    placeholder="Descuento %" style="margin-top:5px;" value="0"
                                                                    autocomplete="off">


                                                                <label for="" id="lbdesc"></label>
                                                                <input id="motivoDescuento" class="form-control"
                                                                    name="motivoDescuento" placeholder="Motivo del descuento"
                                                                    style="">
                                                                <label for="" id="lbmotivoDescuento"></label>
                                                                <input type="hidden" id="descuento1" class="form-control"
                                                                    name="descuento1">
                                                                {{-- <input type="button" class="btn btn-success btn-sm form-control"
                                                                    value="{{ __('Calcular Total') }}" onclick="calcular()"
                                                                    style="margin-top:5px;"> --}}
                                                                <input id="res" class="form-control " name="total" autocomplete="off"
                                                                    placeholder="Subtotal" required style="margin-top:5px;" required
                                                                    readonly="readonly" type="hidden"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbres"></label>

                                                                <input id="propina" class="form-control " name="propina"
                                                                    placeholder="Propina $" style="margin-top:5px;" value="0"
                                                                    autocomplete="off" required>

                                                                <label for="" id="lbpropina"></label>
                                                                {{-- <input id="cupon" class="form-control" name="cupon"
                                                                    placeholder="Cupón $" style="margin-top:5px;" autocomplete="off"
                                                                    required> --}}
                                                                <label for="" id="lbcupon"></label>
                                                                <input id="total2" class="form-control" name="total2"
                                                                    autocomplete="off" placeholder="Total" required
                                                                    style="margin-top:5px;font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtotal2"></label>
                                                                <input id="dos" class="form-control" name="pago" placeholder="Pago"
                                                                    style="margin-top:5px;" autocomplete="off" required>
                                                                <label for="" id="lbdos"></label>
                                                                <input id="tres" class="form-control" name="cambio"
                                                                    placeholder="Cambio" style="margin-top:5px;" autocomplete="off"
                                                                    required readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtres"></label>
                                                            @endif
                                                                                    {{-- == 'Si' --}}
                                                            @if($restaurante['reducir'] != 'No')
                                                                <input type="hidden" id="reducir" name="reducir"
                                                                    class="form-control" value="{{$restaurante['reducir']}}">
                                                                <h1 id="total">0.00</h1>
                                                                <input type="hidden" id="total1" class="form-control" name="total1">
                                                                {{-- <input id="cupon" class="form-control" name="cupon"
                                                                    placeholder="Cupón $" style="margin-top:5px;" autocomplete="off"
                                                                    required> --}}
                                                                <label for="" id="lbcupon"></label>
                                                                <input id="total2" class="form-control" name="total2"
                                                                    autocomplete="off" placeholder="Total" required
                                                                    style="margin-top:5px;font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtotal2"></label>
                                                                <input id="dos" class="form-control" name="pago" placeholder="Pago"
                                                                    style="margin-top:5px;" autocomplete="off" required>
                                                                <label for="" id="lbdos"></label>
                                                                <input id="tres" class="form-control" name="cambio"
                                                                    placeholder="Cambio" style="margin-top:5px;" autocomplete="off"
                                                                    required readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtres"></label>
                                                            @endif
                                                        </th>
                                                        {{--<th></th>--}}
                                                    </tfoot>
                                                    <tbody id="detalle1">
                                                    </tbody>
                                                </table>
                                                <div class="row">

                                                    @if($restaurante['hotel'] != 'No')
                                                    <div class="col-md-7">
                                                    </div>
                                                    <div class="col-md-2" id="consumo">
                                                        <div class="form-group">
                                                            <button class="btn btn-consumo hotelConsumo" id="hConsumo"
                                                                type="button">
                                                                Consumo
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-md-9"></div>
                                                    @endif

                                                    <div class="col-md-3" id="guardar">
                                                        <div class="form-group">
                                                            <button class="btn btn-primary pagar" id="pComanda" type="button">
                                                                Pagar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div><!-- fin row buttons -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <!--  Fin comanda -->
                    </form>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    @elseif(Auth::check() && Auth::user()->role == 'cajero')
        <div class="container">
            <div class="row">
                <!--Mesas-->
                <div class="col-sm-3">
                    <div class="row">
                        <table id="tableUserList" class="table" style="margin-top:10px;">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th style="width:1%">Estado</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="mesaStatus">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Fin Mesas-->

                <div class="col-sm-9">
                    <form method="POST" action="/inicio" id="sample_venta" name="sample_venta" class="form-horizontal"
                        enctype="multipart/form-data">
                        <div class="card border-dark" style="margin-top:10px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" id="fecha" name="fecha" class="form-control"
                                                value="<?php echo date("Y-m-d");?>" required readonly="readonly"
                                                style="background-color:#FFF;cursor: no-drop;">
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mesa">Mesa</label>
                                            <input type="text" name="mesa" id="id_proveedor" class="form-control"
                                                readonly="readonly" style="background-color:#FFF;cursor: no-drop;" required="">
                                            <label for="" id="lbmesa"></label>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cajero">Atiende</label>
                                            <input readonly="readonly" style="background-color:#FFF;cursor: no-drop;"
                                                id="cajero" type="text" class="form-control" name="cajero"
                                                value="{{Auth::user()->name}}" required>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cajero">Forma de pago</label>
                                            <select class="form-control" name="forma_pago" id="forma_pago"
                                                title="Seleccione la forma de pago.">
                                                <option value="" disabled selected>Seleccionar</option>
                                            </select>
                                            <label for="" id="lbpago"></label>
                                        </div>
                                    </div><!-- fin col-md-3 -->
                                    <!--  Sección 2 -->


                                    <div style="display:none" class="col-md-6">
                                        <div class="form-group">
                                            <label name="turnolb" id="turno" for="turnolb">Turno</label>
                                            <input type="text" name="turno" id="turno" value="{{Auth::user()->turno}}"
                                                class="form-control">
                                            <label for="" id="lbturno"></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label name="clientelb" id="clientelb" for="clientelb">Cliente</label>
                                            <input type="text" name="cliente" id="cliente" class="form-control">
                                            <label for="" id="lbcliente"></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label name="direccionlb" id="direccionlb" for="direccionlb">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control">
                                            <label for="" id="lbdireccion"></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--Comanda Productos-->
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-9">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center g-2">
                                            <!-- Seccion 1 -->
                                            @if($restaurante['subcategoria'] != 'No')

                                                <div class="col-12">
                                                    <div class="form-group mb-1" id="searchProducto">
                                                        {{-- <label for="producto">Buscador</label> --}}
                                                        <input id="product_name" value="" class="form-control"
                                                            type="text" placeholder="Buscar Producto"
                                                            data-live-search="true">
                                                    </div>

                                                    <!-- Hover added -->
                                                    <div class="list-group mb-3" id="showProducts" tabindex="1">
                                                        <div id="showProducts"></div>
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <input type="hidden" id="rsubcategoria" class="form-control"
                                                        value="{{ $restaurante['subcategoria'] }}">

                                                        <div class="row justify-content-center align-items-center g-2">

                                                            <div class="col-11">
                                                                <div class="form-group">
                                                                    <label class="mb-0" for="subcategoria">Categoría</label>
                                                                    <select id="select_categoria" name="select_categoria"
                                                                        size="4" class="form-control selectpicker"
                                                                        data-live-search="true">
                                                                        <option selected disabled>-- Selecciona --</option>
                                                                        @foreach($cta as $cta)
                                                                        <option value="{{ $cta->id }}">{{ $cta->titulo }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <div class="form-group">
                                                                    <label class="mb-0" for="subcategoria">Subcategoría</label>
                                                                    <select id="select_subcategoria" name="select_subcategoria"
                                                                        size="4" class="form-control selectpicker"
                                                                        data-live-search="true">
                                                                        <option selected disabled>-- Selecciona --</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="producto" class="mb-0">Producto</label>
                                                                <select id="producto" class="form-control selectpicker"
                                                                    data-live-search="true">
                                                                    <option value="">-- -- --</option>
                                                                </select>
                                                                <input id="pid_articulo" class="form-control user" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-0">
                                                            <div class="form-group">
                                                                <label for="pprecio_compra" class="mb-0">Precio</label>
                                                                <input id="pprecio_compra" class="form-control" type="text"
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbprecio_compra"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" style="margin-top: -1.5rem">
                                                            <label for="pcantidad" class="mb-0">Cantidad</label>
                                                            <input type="number" min="1" max="9" id="pcantidad" class="form-control"
                                                                value="1">
                                                            <label for="" id="lbcantidad"></label>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <button type="button" id="bt_add"
                                                                    class="text-center btn btn-warning">
                                                                    Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else

                                                <div class="col-12">
                                                    <div class="form-group mb-1" id="searchProducto">
                                                        {{-- <label for="producto">Buscador</label> --}}
                                                        <input id="product_name" value="" class="form-control"
                                                            type="text" placeholder="Buscar Producto"
                                                            data-live-search="true">
                                                    </div>

                                                    <!-- Hover added -->
                                                    <div class="list-group mb-3" id="showProducts" tabindex="1">
                                                        <div id="showProducts"></div>
                                                    </div>

                                                </div>

                                                <div class="col-6 pb-5">
                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <input type="hidden" id="rsubcategoria" class="form-control"
                                                            value="{{ $restaurante['subcategoria'] }}">

                                                        <div class="form-group mb-3">
                                                            <label for="select_categoria">Categoría</label>
                                                            <select id="select_categoria" name="select_categoria" size="6"
                                                                class="form-control selectpicker" data-live-search="true">
                                                                <option selected disabled>-- Selecciona una Categoría --
                                                                </option>
                                                                @foreach($cta as $cta)
                                                                <option value="{{ $cta->id }}">{{ $cta->titulo }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">

                                                    <div class="row justify-content-center align-items-center g-2">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="producto" class="mb-0">Producto</label>
                                                                <select id="producto" class="form-control selectpicker"
                                                                    data-live-search="true">
                                                                    <option value="">-- -- --</option>
                                                                </select>
                                                                <input id="pid_articulo" style="z-index:2" class="form-control user" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-0">
                                                            <div class="form-group">
                                                                <label for="pprecio_compra" class="mb-0">Precio</label>
                                                                <input id="pprecio_compra" class="form-control" type="text"
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbprecio_compra"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12" style="margin-top: -1.5rem">
                                                            <label for="pcantidad" class="mb-0">Cantidad</label>
                                                            <input type="number" min="1" max="9" id="pcantidad" class="form-control"
                                                                value="1">
                                                            <label for="" id="lbcantidad"></label>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <button type="button" id="bt_add"
                                                                    class="text-center btn btn-warning">
                                                                    Registrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center g-2">

                                            <!--  Sección 2 -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="mb-0" for="articulo">Producto extra</label>
                                                    <input type="text" id="pespecial" class="form-control">
                                                    <label for="" id="lbpespecial"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.5rem">
                                                <div class="form-group">
                                                    <label class="mb-0" for="pprecio_compra">Precio</label>
                                                    <input type="text" id="pesprecio" class="form-control">
                                                    <label for="" id="lbpesprecio"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.5rem">
                                                <div class="form-group">
                                                    <label class="mb-0" for="pcantidad">Cantidad</label>
                                                    <input type="number" min="1" max="9" id="pespcant" class="form-control"
                                                        value="1">
                                                    <label for="" id="lbpespcant"></label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: -1.01rem">
                                                <div class="form-group text-center">
                                                    <button type="button" id="agrega" class="btn btn-warning">
                                                        Registrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--  Fin Productos -->

                        <!--Comanda Restante -->
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row">

                                            <!--  Sección comentarios -->
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label name="comentariolb" id="comentariolb"
                                                        for="comentariolb">Comentarios</label>
                                                    <input type="text" name="comentario" id="comentario" class="form-control" value="Ninguno">
                                                    <label for="" id="lbcomentario"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="margin-top:30px">
                                                <div class="form-group">
                                                    <button type="button" id="guardarComentario" class="btn btn-warning">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                            <!--  Sección 3 -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="userDescuento" name="userDescuento"
                                                        value="{{$cajero->descuento}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="motivo" name="motivo" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="valor" name="valor" class="form-control" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="incrementa" name="incrementa" class="form-control"
                                                        value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" id="mesa_estado" name="mesa_estado"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-md-2" style="margin-top:30px">
                                                <div class="form-group">
                                                    <button type="button" id="guardarComanda" class="btn btn-primary">
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="table-responsive" style="overflow:hidden;">
                                                <table id="detalles" name="detalles" class="table table-bordered table-striped"
                                                    style="margin-top: 10px">
                                                    <thead class="table-success">
                                                        <th>Acciones</th>
                                                        <th>Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio Compra</th>
                                                        <th>Subtotal</th>
                                                    </thead>
                                                    <tfoot>
                                                        <th id="totalEtiqueta">Subtotal</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>

                                                            {{-- Pago Form --}}

                                                                                    {{-- == 'No' --}}
                                                            @if($restaurante['reducir'] != 'Si')
                                                                <input type="hidden" id="reducir" name="reducir"
                                                                    class="form-control" value="{{$restaurante['reducir']}}">
                                                                <h1 id="total" style="margin-bottom: -1rem;">0.00</h1>
                                                                <input type="hidden" id="total1" class="m-0" name="total1">
                                                                <input id="conftotal" class="m-0" name="conf_total" type="hidden"
                                                                    placeholder="Confirma el importe" style="" autocomplete="off" required>
                                                                <label for="" id="lbconf_total"></label>


                                                                <input id="desc" class="form-control" name="descuento" onchange="calcular()"
                                                                    placeholder="Descuento %" style="margin-top:5px;" value="0"
                                                                    autocomplete="off">


                                                                <label for="" id="lbdesc"></label>
                                                                <input id="motivoDescuento" class="form-control"
                                                                    name="motivoDescuento" placeholder="Motivo del descuento"
                                                                    style="">
                                                                <label for="" id="lbmotivoDescuento"></label>
                                                                <input type="hidden" id="descuento1" class="form-control"
                                                                    name="descuento1">
                                                                {{-- <input type="button" class="btn btn-success btn-sm form-control"
                                                                    value="{{ __('Calcular Total') }}" onclick="calcular()"
                                                                    style="margin-top:5px;"> --}}
                                                                <input id="res" class="form-control " name="total" autocomplete="off"
                                                                    placeholder="Subtotal" required style="margin-top:5px;" required
                                                                    readonly="readonly" type="hidden"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbres"></label>


                                                                <input id="propina" class="form-control " name="propina"
                                                                    placeholder="Propina $" style="margin-top:5px;" value="0"
                                                                    autocomplete="off">


                                                                <label for="" id="lbpropina"></label>
                                                                {{-- <input id="cupon" class="form-control" name="cupon"
                                                                    placeholder="Cupón $" style="margin-top:5px;" autocomplete="off"
                                                                    required> --}}
                                                                <label for="" id="lbcupon"></label>
                                                                <input id="total2" class="form-control" name="total2"
                                                                    autocomplete="off" placeholder="Total" required
                                                                    style="margin-top:5px;font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtotal2"></label>
                                                                <input id="dos" class="form-control" name="pago" placeholder="Pago"
                                                                    style="margin-top:5px;" autocomplete="off" required>
                                                                <label for="" id="lbdos"></label>
                                                                <input id="tres" class="form-control" name="cambio"
                                                                    placeholder="Cambio" style="margin-top:5px;" autocomplete="off"
                                                                    required readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtres"></label>
                                                            @endif
                                                                                    {{-- == 'Si' --}}
                                                            @if($restaurante['reducir'] != 'No')
                                                                <input type="hidden" id="reducir" name="reducir"
                                                                    class="form-control" value="{{$restaurante['reducir']}}">
                                                                <h1 id="total">0.00</h1>
                                                                <input type="hidden" id="total1" class="form-control" name="total1">
                                                                {{-- <input id="cupon" class="form-control" name="cupon"
                                                                    placeholder="Cupón $" style="margin-top:5px;" autocomplete="off"
                                                                    required> --}}
                                                                <label for="" id="lbcupon"></label>
                                                                <input id="total2" class="form-control" name="total2"
                                                                    autocomplete="off" placeholder="Total" required
                                                                    style="margin-top:5px;font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtotal2"></label>
                                                                <input id="dos" class="form-control" name="pago" placeholder="Pago"
                                                                    style="margin-top:5px;" autocomplete="off" required>
                                                                <label for="" id="lbdos"></label>
                                                                <input id="tres" class="form-control" name="cambio"
                                                                    placeholder="Cambio" style="margin-top:5px;" autocomplete="off"
                                                                    required readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtres"></label>
                                                            @endif
                                                        </th>
                                                        {{--<th></th>--}}
                                                    </tfoot>
                                                    <tbody id="detalle1">
                                                    </tbody>
                                                </table>
                                                <div class="row">

                                                    <div class="col-md-9"></div>

                                                    <div class="col-md-3" id="guardar">
                                                        <div class="form-group">
                                                            <button class="btn btn-primary pagar" id="pComanda" type="button">
                                                                Pagar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div><!-- fin row buttons -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <!--  Fin comanda -->
                    </form>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    @else
        @include('error')
    @endif
@endsection

@section('funciones')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    {{-- Guardar Comentarios y Reiniciar Mesa --}}
    <script type="text/javascript">

        $(document).ready(function () {
            $("#guardarComentario").click(function () {
                guardarComentario();

            });
        });

        function guardarComentario() {
            var fecha = document.getElementById('fecha').value;
            var mesa = document.getElementById('id_proveedor').value;
            var estado = document.getElementById('mesa_estado').value;
            var cajero = document.getElementById('cajero').value;
            var cliente = document.getElementById('cliente').value;
            var direccion = document.getElementById('direccion').value;
            var comentario = document.getElementById('comentario').value;

            if (comentario != "" && mesa != "") {

                var data = {
                    "fecha": fecha,
                    "mesa": mesa,
                    "estado": estado,
                    "cajero": cajero,
                    "cliente": cliente,
                    "direccion": direccion,
                    "comentario": comentario
                };

                $.ajax({
                    url: "/guardarComentario",
                    type: "POST",
                    data: data,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'No se ha podido guardar 1!',

                        })
                    }
                });
                reiniciar();
                var lbcomentario = document.getElementById('lbcomentario');
                lbcomentario.innerHTML = '';

                Swal.fire(
                    'Guardado!',
                    'El comentario ha sido guardado exitosamente.',
                    'success'
                )

            } else {

                if (mesa.trim() == '') {
                    $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                    $('#id_proveedor').focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error el campo mesa es obligatorio, seleccione la mesa!',
                    })
                    return false;
                } else if (comentario == '') {
                    $('#lbcomentario').html("<span style='color:red;'>Ingrese el comentario</span>");
                    $('#comentario').focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error el campo comentario es obligario, ingrese el comentario!',
                    })
                    return false;
                }
            }

        }

        function reiniciar() {
            var k = document.getElementById("tableUserList").rows.length;
            var elementos = document.getElementsByName("estado_mesa2");
            for (y = 0; y < elementos.length; y++) {
                j = y + 1;
                if (elementos[y].value == "Abierta") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#6cb2eb;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Ver mesa";
                } else if (elementos[y].value == "Cerrada") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#6cb2eb;;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Abrir mesa";
                }
            }
        }

    </script>

    {{-- Cambiar el Estado de la Mesa --}}
    <script>
        setTimeout(function(){

            function syncWIthApis1(){
                $('#estado_mesa').on('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "/Mesa",
                        type: "POST",
                        data: $('#estado_mesa').serialize(),
                        success: function (data) {
                            console.log(data);
                            swal('Exito!', 'Actualizado', 'success');
                        },
                        error: function (error) {
                            console.log(error);
                            swal('Error!', 'No se ha podido actualizar', 'warning');
                        }

                    });
                });
            }

            $(document).ready(function () {
                setTimeout(syncWIthApis1, 950);
            });
        }, 1500);

    </script>

    {{-- Funciones - Ultima parte del Formulario --}}
    <script>
        $(document).ready(function () {
            $(".user").hide()

            if ($('#reducir').val() != 'No') {
                function multiplicar() {
                    var uno, dos, tres, operacion, total2;
                    // var uno, dos, tres, operacion, cupon, total2;
                    uno = $('#total1');
                    dos = $('#dos');
                    tres = $('#tres');
                    // cupon = $('#cupon');
                    total2 = $('#total2');
                    totalc = parseFloat(uno.val());
                    // totalc = parseFloat(uno.val()) - parseFloat(cupon.val());
                    document.getElementById("total2").value = totalc.toFixed(2);
                    operacion = parseFloat(dos.val()) - parseFloat(total2.val());
                    document.getElementById("tres").value = operacion.toFixed(2);
                    // if ($('#cupon').val() > 0) {
                    //     $('#comentario').val('Pago con cupon de ' + cupon.val());
                    // }
                }

                $("#dos").keyup(function () {
                    var uno;
                    uno = $('#total1').val();
                    if (dos != "") {
                        multiplicar()
                    }
                });

                $("#total2").keyup(function () {
                    var dos;
                    dos = $('#dos').val();
                    if (dos != "") {
                        multiplicar()
                    }
                });

            } else {

                function multiplicar() {
                    var uno, dos, tres, operacion;
                    // var uno, dos, tres, operacion, cupon;
                    uno = $('#total2');
                    dos = $('#dos');
                    tres = $('#tres');
                    // cupon = $('#cupon');
                    totalc = parseFloat(uno.val());
                    // totalc = parseFloat(uno.val()) - parseFloat(cupon.val());
                    operacion = parseFloat(dos.val()) - parseFloat(uno.val());
                    document.getElementById("tres").value = operacion.toFixed(2);
                    // if ($('#total1').val() > 0) {
                    //     $('#comentario').val('Pago con cupon de ' + cupon.val());
                    // }
                }

                function suma() {
                    var propina, subtotal, operacion2, total2;
                    // var propina, subtotal, operacion2, total2, cupon;
                    propina = $('#propina')
                    subtotal = $('#res')
                    total2 = $('#total2')
                    // cupon = $('#cupon')
                    // console.log(cupon.val());
                    operacion2 = parseFloat(propina.val()) + parseFloat(subtotal.val());
                    totalc = parseFloat(operacion2);
                    // totalc = parseFloat(operacion2) - parseFloat(cupon.val());
                    document.getElementById("total2").value = totalc.toFixed(2);
                    // if ($('#cupon').val() > 0) {
                    //     $('#comentario').val('Pago con cupon de ' + cupon.val());
                    // }
                }

                $("#total2").keyup(function () {
                    var dos;
                    dos = $('#dos').val();
                    if (dos != "") {
                        multiplicar()
                    }
                });

                $("#dos").keyup(function () {
                    var uno;
                    uno = $('#total2').val();
                    if (dos != "") {
                        multiplicar()
                    }
                });

                $("#res").keyup(function () {
                    var propina;
                    propina = $('#propina').val();
                    if (propina != "") {
                        suma()
                    }
                });

                $("#propina").keyup(function () {
                    var res;
                    res = $('#res').val();
                    if (res != "") {
                        suma()
                    }
                });
                // $("#cupon").keyup(function () {
                //     var res;
                //     res = $('#propina').val();
                //     if (res != "") {
                //         suma()
                //     }
                // });

                $("#desc").keyup(function () {
                    var res;
                    res = $('#desc').val();
                    if (res > 0) {
                        //suma()
                        $("#motivoDescuento").show();

                    } else {
                        $("#motivoDescuento").hide();
                    }
                });

            }
        })

    </script>

    <!-- Calcular Total -->
    <script>

        $('#desc').on('change',function(e){
            alert('Changed!')
        });

        function calcular() {

            var conftotal = document.getElementById('conftotal').value;
            var propina = document.getElementById('propina').value;
            var num = document.getElementById('desc').value;
            var sum = parseInt(conftotal);
            var desc = (sum * num) / 100;

            document.getElementById("res").value = conftotal - desc;
            document.getElementById('descuento1').value = desc;

            if(propina == '' || propina == 0){
                document.getElementById("total2").value = conftotal - desc;
            }

            // var sum2 = parseInt(propina);
        }

    </script>

    <!-- Script para las ventas-->
    <script>
        $(document).ready(function () {
            $("#bt_add").click(function () {
                agregar();

            });
        });

        var suma = 0;
        var total = 0;
        var sumatotal = 0;
        var num = 0;
        var base = 0;
        var i = 0;
        var indice = 0;
        var index = 0;
        var contador = 0;

        $("#consumo").hide();
        $("#guardar").hide();
        $("#cliente").hide();
        $("#direccion").hide();
        $("#clientelb").hide();
        $("#direccionlb").hide();
        $("#motivoDescuento").hide();

        function agregar() {
            //Obtener los valores de los inputs
            id_articulo = $("#pid_articulo").val();
            articulo = $("#pid_articulo").val();
            cantidad = $("#pcantidad").val();
            precio_compra = $("#pprecio_compra").val();
            indice = $('#incrementa').val();

            var fecha = document.getElementById('fecha').value;
            var mesa = document.getElementById('id_proveedor').value;
            var estado = document.getElementById('mesa_estado').value;
            var cajero = document.getElementById('cajero').value;
            var cliente = document.getElementById('cliente').value;
            var direccion = document.getElementById('direccion').value;
            var comentario = document.getElementById('comentario').value;

            if (mesa != "Para llevar") {
                if (id_articulo != "" && cantidad > 0 && precio_compra != "" && mesa != "") {

                    //Borrar los errores.
                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';

                    contador = (cantidad * precio_compra);
                    num = $('#valor').val();
                    total = parseFloat(num);
                    suma = total + contador;
                    base = suma.toFixed(2);
                    sumatotal = contador.toFixed(2);

                    var fila = '<tr class="selected" id="fila' + indice + '">' +
                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + indice + ',' + sumatotal +
                        ')">Eliminar</button></td>' +
                        '<td><input type="hidden" id="articulo" name="articulo[] class="articulo" value="' + id_articulo +
                        '">' + articulo + '</td>' +
                        '<td><input type="hidden" id="cantidad" name="cantidad[]" value="' + cantidad + '">' + cantidad +
                        '</td>' +
                        '<td><input type="hidden" id="precio_compra" name="precio_compra[]" value="' + precio_compra +
                        '">' + precio_compra + '</td>' +
                        '<td><input type="hidden" id="subtotal" name="subtotal[]" value="' + sumatotal + '">' + sumatotal +
                        '</td>' +
                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                        indice + '"></td></tr>';

                    var data = {
                        "fecha": fecha,
                        "indice": indice,
                        "mesa": mesa,
                        "estado": estado,
                        "cajero": cajero,
                        "articulo": articulo,
                        "cantidad": cantidad,
                        "precio_compra": precio_compra,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComanda",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            index = $('#incrementa').val();
                            var i = parseInt(index) + 1;
                            $('#incrementa').val(i);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 2!',

                            })
                        }
                    });

                    limpiar();
                    if ($('#reducir').val() != 'Si') {
                        var lbconf_total = document.getElementById('lbconf_total');
                        lbconf_total.innerHTML = '';
                        var lbdesc = document.getElementById('lbdesc');
                        lbdesc.innerHTML = '';
                        var lbres = document.getElementById('lbres');
                        lbres.innerHTML = '';
                        var lbpropina = document.getElementById('lbpropina');
                        lbpropina.innerHTML = '';
                        var lbtotal2 = document.getElementById('lbtotal2');
                        lbtotal2.innerHTML = '';
                        var lbcupon = document.getElementById('lbcupon');
                        lbcupon.innerHTML = '';
                        var lbdos = document.getElementById('lbdos');
                        lbdos.innerHTML = '';
                        var lbtres = document.getElementById('lbtres');
                        lbtres.innerHTML = '';
                        var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                        lbmotivoDescuento.innerHTML = '';
                        var lbcomentario = document.getElementById('lbcomentario');
                        lbcomentario.innerHTML = '';
                    } else {

                        var lbtotal2 = document.getElementById('lbtotal2');
                        lbtotal2.innerHTML = '';
                        var lbcupon = document.getElementById('lbcupon');
                        lbcupon.innerHTML = '';
                        var lbdos = document.getElementById('lbdos');
                        lbdos.innerHTML = '';
                        var lbtres = document.getElementById('lbtres');
                        lbtres.innerHTML = '';
                    }
                    // $('#cupon').val("");
                    $('#conftotal').val("");
                    $('#desc').val("");
                    $('#res').val("");
                    $('#propina').val("");
                    $('#total2').val("");
                    $('#dos').val("");
                    $('#tres').val("");
                    $('#motivoDescuento').val("");

                    $("#pcantidad").val("1");
                    $("#pprecio_compra").val("");
                    $("#select-categoria").val("");
                    $("#producto").val("");
                    $("#comentario").val("");
                    $("#total").html("$" + base);
                    $("#conftotal").val(base);
                    $('#valor').val(base);
                    $('#total1').val(base);
                    $('#total2').val(base);
                    evaluar();
                    $("#detalles").append(fila);
                    reiniciar();
                    calcular();
                    // Swal.fire(
                    //     'Registrado!',
                    //     'El producto ha sido registrado.',
                    //     'success'
                    // )
                } else {

                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo mesa es obligatorio, seleccione la mesa!',
                        })
                        return false;
                    } else if (precio_compra == '' || precio_compra <= 0 || isNaN(precio_compra) || precio_compra == null) {
                        $('#lbprecio_compra').html("<span style='color:red;'>Seleccione un producto</span>");
                        $('#pprecio_compra').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo precio compra es obligario, seleccione el producto!',
                        })
                        return false;
                    } else if (cantidad == '' || cantidad <= 0 || isNaN(cantidad) || cantidad == null) {
                        $('#lbcantidad').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pcantidad').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cantidad es obligatorio, seleccione la cantidad!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al ingresar el detalle del ingreso, revise los datos del artículo!',
                        })
                        return false;
                    }
                }

            } else if (mesa == "Para llevar") {
                if (cliente != "" && direccion != "" && id_articulo != "" && cantidad > 0 && precio_compra != "" && mesa !=
                    "") {

                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';
                    var lbcliente = document.getElementById('lbcliente');
                    lbcliente.innerHTML = '';
                    var lbdireccion = document.getElementById('lbdireccion');
                    lbdireccion.innerHTML = '';

                    contador = (cantidad * precio_compra);
                    num = $('#valor').val();
                    total = parseFloat(num);
                    suma = total + contador;
                    base = suma.toFixed(2);
                    sumatotal = contador.toFixed(2);

                    var fila = '<tr class="selected" id="fila' + indice + '">' +
                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + indice + ',' + sumatotal +
                        ')">Eliminar</button></td>' +
                        '<td><input type="hidden" id="articulo" name="articulo[] class="articulo" value="' + id_articulo +
                        '">' + articulo + '</td>' +
                        '<td><input type="hidden" id="cantidad" name="cantidad[]" value="' + cantidad + '">' + cantidad +
                        '</td>' +
                        '<td><input type="hidden" id="precio_compra" name="precio_compra[]" value="' + precio_compra +
                        '">' + precio_compra + '</td>' +
                        '<td><input type="hidden" id="subtotal" name="subtotal[]" value="' + sumatotal + '">' + sumatotal +
                        '</td>' +
                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                        indice + '"></td></tr>';

                    var data = {
                        "fecha": fecha,
                        "indice": indice,
                        "mesa": mesa,
                        "estado": estado,
                        "cajero": cajero,
                        "articulo": articulo,
                        "cantidad": cantidad,
                        "precio_compra": precio_compra,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComanda",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            index = $('#incrementa').val();
                            var i = parseInt(index) + 1;
                            $('#incrementa').val(i);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 3!',

                            })
                        }
                    });
                    limpiar();
                    if ($('#reducir').val() != 'Si') {
                        var lbconf_total = document.getElementById('lbconf_total');
                        lbconf_total.innerHTML = '';
                        var lbdesc = document.getElementById('lbdesc');
                        lbdesc.innerHTML = '';
                        var lbres = document.getElementById('lbres');
                        lbres.innerHTML = '';
                        var lbpropina = document.getElementById('lbpropina');
                        lbpropina.innerHTML = '';
                        var lbtotal2 = document.getElementById('lbtotal2');
                        lbtotal2.innerHTML = '';
                        var lbcupon = document.getElementById('lbcupon');
                        lbcupon.innerHTML = '';
                        var lbdos = document.getElementById('lbdos');
                        lbdos.innerHTML = '';
                        var lbtres = document.getElementById('lbtres');
                        lbtres.innerHTML = '';
                        var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                        lbmotivoDescuento.innerHTML = '';
                        var lbcomentario = document.getElementById('lbcomentario');
                        lbcomentario.innerHTML = '';
                    } else {
                        var lbtotal2 = document.getElementById('lbtotal2');
                        lbtotal2.innerHTML = '';
                        var lbcupon = document.getElementById('lbcupon');
                        lbcupon.innerHTML = '';
                        var lbdos = document.getElementById('lbdos');
                        lbdos.innerHTML = '';
                        var lbtres = document.getElementById('lbtres');
                        lbtres.innerHTML = '';
                    }
                    // $('#cupon').val("");
                    $('#conftotal').val("");
                    $('#desc').val("");
                    $('#res').val("");
                    $('#propina').val("");
                    $('#total2').val("");
                    $('#dos').val("");
                    $('#tres').val("");
                    $('#motivoDescuento').val("");

                    $("#pcantidad").val("1");
                    $("#pprecio_compra").val("");
                    $("#select-categoria").val("");
                    $("#producto").val("");
                    $("#comentario").val("");
                    $("#total").html("$" + base);
                    $("#conftotal").val(base);
                    $('#valor').val(base);
                    $('#total1').val(base);
                    $('#total2').val(base);
                    evaluar();
                    $("#detalles").append(fila);
                    reiniciar();
                    calcular();
                    // Swal.fire(
                    //     'Registrado!',
                    //     'El producto ha sido registrado.',
                    //     'success'
                    // )
                } else {

                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo mesa es obligatorio, seleccione la mesa!',
                        })
                        return false;
                    } else if (cliente == '') {
                        $('#lbcliente').html("<span style='color:red;'>Ingrese el cliente</span>");
                        $('#cliente').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cliente es obligatorio, ingrese el cliente!',
                        })
                        return false;
                    } else if (direccion == '') {
                        $('#lbdireccion').html("<span style='color:red;'>Ingrese la dirección</span>");
                        $('#direccion').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo dirección es obligatorio, ingrese la dirección!',
                        })
                        return false;
                    } else if (precio_compra == '' || precio_compra <= 0 || isNaN(precio_compra) || precio_compra == null) {
                        $('#lbprecio_compra').html("<span style='color:red;'>Seleccione un producto</span>");
                        $('#pprecio_compra').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo precio compra es obligatorio, seleccione el producto!',

                        })
                        return false;
                    } else if (cantidad == '' || cantidad <= 0 || isNaN(cantidad) || cantidad == null) {
                        $('#lbcantidad').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pcantidad').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cantidad es obligatorio, seleccione la cantidad!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al ingresar el detalle del ingreso, revise los datos del artículo!',
                        })
                        return false;
                    }
                }
            } else if (mesa == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error ingrese la mesa',
                })

            }
        }


        function limpiar() {
            if ($('#reducir').val() != 'Si') {
                var lbconf_total = document.getElementById('lbconf_total');
                lbconf_total.innerHTML = '';
                var lbdesc = document.getElementById('lbdesc');
                lbdesc.innerHTML = '';
                var lbres = document.getElementById('lbres');
                lbres.innerHTML = '';
                var lbpropina = document.getElementById('lbpropina');
                lbpropina.innerHTML = '';
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                lbmotivoDescuento.innerHTML = '';
                var lbcomentario = document.getElementById('lbcomentario');
                lbcomentario.innerHTML = '';
            } else {
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
            }
            // $('#cupon').val("");
            $('#conftotal').val("");
            $('#desc').val("");
            $('#res').val("");
            $('#propina').val("");
            $('#total2').val("");
            $('#dos').val("");
            $('#tres').val("");
            $('#motivoDescuento').val("");

            $("#select-categoria").val("");
            $("#producto").val("");
            $("#pprecio_compra").val("");
            $("#pcantidad").val("1");
            $("#pespecial").val("");
            $("#pesprecio").val("");
            $("#pespcant").val("1");
            $("#comentario").val("");
        }

        function evaluar() {
            if (base > 0) {
                $("#guardar").show();
                $("#consumo").show();
            } else {
                $("#guardar").hide();
                $("#consumo").hide();
            }

        }

        function eliminar(index, subtotal) {
            base = $('#valor').val();
            base = base - subtotal;
            $('#valor').val(base);
            $('#conftotal').val(base);
            $("#total").html("$" + base);
            $("#fila" + index).remove();
            evaluar();
        }

        function reiniciar() {
            var k = document.getElementById("tableUserList").rows.length;
            var elementos = document.getElementsByName("estado_mesa2");
            for (y = 0; y < elementos.length; y++) {
                j = y + 1;
                if (elementos[y].value == "Abierta") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Ver mesa";
                } else if (elementos[y].value == "Cerrada") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Abrir mesa";
                }
            }
        }

    </script>

    <!--  Script para Boton guardarComanda -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#guardarComanda").click(function () {
                limpiarSeleccion();
            });
        });

        function limpiarSeleccion() {
            if ($('#reducir').val() != 'Si') {
                var lbconf_total = document.getElementById('lbconf_total');
                lbconf_total.innerHTML = '';
                var lbdesc = document.getElementById('lbdesc');
                lbdesc.innerHTML = '';
                var lbres = document.getElementById('lbres');
                lbres.innerHTML = '';
                var lbpropina = document.getElementById('lbpropina');
                lbpropina.innerHTML = '';
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                lbmotivoDescuento.innerHTML = '';
                var lbcomentario = document.getElementById('lbcomentario');
                lbcomentario.innerHTML = '';
            } else {
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
            }
            // $('#cupon').val("");
            $('#conftotal').val("");
            $('#desc').val("");
            $('#res').val("");
            $('#propina').val("");
            $('#total2').val("");
            $('#dos').val("");
            $('#tres').val("");
            $('#motivoDescuento').val("");

            $("#select-categoria").val("");
            $("#producto").val("");
            $("#pprecio_compra").val("");
            $("#pcantidad").val("1");
            $("#pespecial").val("");
            $("#pesprecio").val("");
            $("#pespcant").val("1");
            $("#id_proveedor").val("");
            $("#comentario").val("");

            var elementos = document.getElementsByName("estado_mesa2");
            for (y = 0; y < elementos.length; y++) {
                j = y + 1;
                if (elementos[y].value == "Abierta") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Ver mesa";
                } else if (elementos[y].value == "Cerrada") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Abrir mesa";
                }
            }
            $(location).attr('href', '/home');
        }

    </script>

    <!--  Script para Especialidades  -->
    <script>
        $(document).ready(function () {
            $("#agrega").click(function () {
                agrega();

            });
        });

        var total = 0;
        var suma = 0;
        var sumatotal = 0;
        var num = 0;
        var base = 0;
        var i = 0;
        var indice = 0;
        var index = 0;
        var contador = 0;

        function agrega() {

            especialidad = $("#pespecial").val();
            esprecio = $("#pesprecio").val();
            espcant = $("#pespcant").val();
            indice = $('#incrementa').val();

            var fecha = document.getElementById('fecha').value;
            var mesa = document.getElementById('id_proveedor').value;
            var estado = document.getElementById('mesa_estado').value;
            var cajero = document.getElementById('cajero').value;
            var cliente = document.getElementById('cliente').value;
            var direccion = document.getElementById('direccion').value;
            var comentario = document.getElementById('comentario').value;

            if (mesa != "Para llevar") {
                if (especialidad != "" && espcant > 0 && esprecio != "" && mesa != "") {

                    esprecio = esprecio + ".00";
                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';

                    contador = (espcant * esprecio);
                    num = $('#valor').val();
                    total = parseFloat(num);
                    suma = total + contador;
                    base = suma.toFixed(2);
                    sumatotal = contador.toFixed(2);

                    var fila = '<tr class="selected" id="fila' + indice + '">' +
                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + indice + ',' + sumatotal +
                        ')">Eliminar</button></td>' +
                        '<td><input type="hidden" id="articulo" name="articulo[]" value="' + especialidad + '">' +
                        especialidad + '</td>' +
                        '<td><input type="hidden" id="cantidad" name="cantidad[]" value="' + espcant + '">' + espcant +
                        '</td>' +
                        '<td><input type="hidden" id="precio_compra" name="precio_compra[]" value="' + esprecio + '">' +
                        esprecio + '</td>' +
                        '<td><input type="hidden" id="subtotal" name="subtotal[]" value="' + sumatotal + '">' + sumatotal +
                        '</td>' +
                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                        indice + '"></td></tr>';

                    var data = {
                        "fecha": fecha,
                        "indice": indice,
                        "mesa": mesa,
                        "estado": estado,
                        "cajero": cajero,
                        "articulo": especialidad,
                        "cantidad": espcant,
                        "precio_compra": esprecio,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComandaExtra",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            index = $('#incrementa').val();
                            var i = parseInt(index) + 1;
                            $('#incrementa').val(i);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 4!',
                            })
                        }
                    });

                    limpiar();
                    $("#total").html("$" + base);
                    $('#valor').val(base);
                    $('#total1').val(base);
                    $('#total2').val(base);
                    $('#conftotal').val(base);
                    evaluar();
                    $("#detalles").append(fila);
                    reiniciar();
                    calcular();
                    // Swal.fire(
                    //     'Registrado!',
                    //     'El producto ha sido registrado.',
                    //     'success'
                    // )

                } else {
                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo mesa es obligatorio, seleccione la mesa!',
                        })
                        return false;
                    } else if (especialidad.trim() == '') {
                        $('#lbpespecial').html("<span style='color:red;'>Ingrese la especialidad</span>");
                        $('#pespecial').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo producto extra es obligatorio, ingrese la especialidad!',
                        })
                        return false;
                    } else if (esprecio == '' || esprecio <= 0 || isNaN(esprecio) || esprecio == null) {
                        $('#lbpesprecio').html("<span style='color:red;'>Ingrese el precio</span>");
                        $('#pesprecio').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo precio es obligatorio, ingrese el precio!',
                        })
                        return false;
                    } else if (espcant.trim() == '' || isNaN(espcant) || espcant == null || espcant <= 0) {
                        $('#lbpespcant').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pespcant').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cantidad es obligatorio, ingrese la cantidad!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al ingresar el detalle del ingreso extra, Complete los datos!',
                        })
                        return false;
                    }
                }
            } else if (mesa == "Para llevar") {
                if (cliente != "" && direccion != "" && especialidad != "" && espcant > 0 && esprecio != "" && mesa != "") {

                    esprecio = esprecio + ".00";
                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';
                    var lbcliente = document.getElementById('lbcliente');
                    lbcliente.innerHTML = '';
                    var lbdireccion = document.getElementById('lbdireccion');
                    lbdireccion.innerHTML = '';

                    contador = (espcant * esprecio);
                    num = $('#valor').val();
                    total = parseFloat(num);
                    suma = total + contador;
                    base = suma.toFixed(2);
                    sumatotal = contador.toFixed(2);

                    var fila = '<tr class="selected" id="fila' + indice + '">' +
                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + indice + ',' + sumatotal +
                        ')">Eliminar</button></td>' +
                        '<td><input type="hidden" id="articulo" name="articulo[]" value="' + especialidad + '">' +
                        especialidad + '</td>' +
                        '<td><input type="hidden" id="cantidad" name="cantidad[]" value="' + espcant + '">' + espcant +
                        '</td>' +
                        '<td><input type="hidden" id="precio_compra" name="precio_compra[]" value="' + esprecio + '">' +
                        esprecio + '</td>' +
                        '<td><input type="hidden" id="subtotal" name="subtotal[]" value="' + sumatotal + '">' + sumatotal +
                        '</td>' +
                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                        indice + '"></td></tr>';

                    var data = {
                        "fecha": fecha,
                        "indice": indice,
                        "mesa": mesa,
                        "estado": estado,
                        "cajero": cajero,
                        "articulo": especialidad,
                        "cantidad": espcant,
                        "precio_compra": esprecio,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComandaExtra",
                        type: "POST",
                        data: data,
                        success: function (data) {
                            console.log(data);
                            index = $('#incrementa').val();
                            var i = parseInt(index) + 1;
                            $('#incrementa').val(i);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 5!',
                            })
                        }
                    });

                    limpiar();
                    $("#total").html("$" + base);
                    $('#valor').val(base);
                    $('#total1').val(base);
                    $('#total2').val(base);
                    $('#conftotal').val(base);
                    evaluar();
                    $("#detalles").append(fila);
                    reiniciar();
                    calcular();
                    // Swal.fire(
                    //     'Registrado!',
                    //     'El producto ha sido registrado.',
                    //     'success'
                    // )

                } else {
                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo mesa es obligatorio, seleccione la mesa!',
                        })
                        return false;
                    } else if (cliente == '') {
                        $('#lbcliente').html("<span style='color:red;'>Ingrese el cliente</span>");
                        $('#cliente').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cliente es obligatorio, ingrese el cliente!',
                        })
                        return false;
                    } else if (direccion == '') {
                        $('#lbdireccion').html("<span style='color:red;'>Ingrese la dirección</span>");
                        $('#direccion').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo direccion es obligatorio, ingrese la dirección!',
                        })
                        return false;
                    } else if (especialidad.trim() == '') {
                        $('#lbpespecial').html("<span style='color:red;'>Ingrese la especialidad</span>");
                        $('#pespecial').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo producto extra es obligatorio, ingrese la especialidad!',
                        })
                        return false;
                    } else if (esprecio == '' || esprecio <= 0 || isNaN(esprecio) || esprecio == null) {
                        $('#lbpesprecio').html("<span style='color:red;'>Ingrese el precio</span>");
                        $('#pesprecio').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo precio es obligatorio, ingrese el precio!',
                        })
                        return false;
                    } else if (espcant.trim() == '' || isNaN(espcant) || espcant == null || espcant <= 0) {
                        $('#lbpespcant').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pespcant').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el campo cantidad es obligatorio, ingrese la cantidad!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al ingresar el detalle del ingreso extra, Complete los datos!',
                        })
                        return false;
                    }
                }
            } else if (mesa == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error ingrese la mesa!',
                })
            }
        }

        function limpiar() {
            if ($('#reducir').val() != 'Si') {
                var lbconf_total = document.getElementById('lbconf_total');
                lbconf_total.innerHTML = '';
                var lbdesc = document.getElementById('lbdesc');
                lbdesc.innerHTML = '';
                var lbres = document.getElementById('lbres');
                lbres.innerHTML = '';
                var lbpropina = document.getElementById('lbpropina');
                lbpropina.innerHTML = '';
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                lbmotivoDescuento.innerHTML = '';
                var lbcomentario = document.getElementById('lbcomentario');
                lbcomentario.innerHTML = '';
            } else {
                var lbtotal2 = document.getElementById('lbtotal2');
                lbtotal2.innerHTML = '';
                var lbcupon = document.getElementById('lbcupon');
                lbcupon.innerHTML = '';
                var lbdos = document.getElementById('lbdos');
                lbdos.innerHTML = '';
                var lbtres = document.getElementById('lbtres');
                lbtres.innerHTML = '';
            }
            $('#cupon').val("");
            $('#conftotal').val("");
            $('#desc').val("");
            $('#res').val("");
            $('#propina').val("");
            $('#total2').val("");
            $('#dos').val("");
            $('#tres').val("");
            $('#motivoDescuento').val("");

            $("#pespcant").val("1");
            $("#pesprecio").val("");
            $("#pespecial").val("");
            $("#comentario").val("");
        }

        function evaluar() {
            if (base > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index, subtotal) {
            base = $('#valor').val();
            base = base - subtotal;
            $('#valor').val(base);
            $('#conftotal').val(base);
            $("#total").html("$" + base);
            $("#fila" + index).remove();
            evaluar();
        }

        function reiniciar() {
            var elementos = document.getElementsByName("estado_mesa2");
            for (y = 0; y < elementos.length; y++) {
                j = y + 1;
                if (elementos[y].value == "Abierta") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Ver mesa";
                    $("#cerrar").show("slow");
                } else if (elementos[y].value == "Cerrada") {
                    document.getElementsByTagName("button")[j].setAttribute("style", "background-color:#FFFFFF;");
                    document.getElementsByTagName("button")[j].disabled = false;
                    document.getElementsByTagName("button")[j].innerHTML = "Abrir mesa";
                }
            }
        }

    </script>

    {{-- Guardar Orden en la BD--}}
    <script>
        $(document).ready(function () {

            $('.pagar').click(function () {
                if ($('#reducir').val() != 'Si') {
                    var mesaTitulo = $('#id_proveedor').val();
                    var conftotal = document.getElementById('conftotal').value;
                    var total = document.getElementById('total');
                    var total1 = total.innerHTML;
                    var cadena = total1.substring(1);
                    var tot = parseInt(cadena);
                    var res = document.getElementById('res').value;
                    var res1 = parseInt(res);
                    var dos = document.getElementById('dos').value;
                    var dos1 = parseInt(dos);
                    var tcomanda = document.getElementById('total1').value;
                    var tcomanda = parseInt(tcomanda);
                    // var cupon = document.getElementById('cupon').value;
                    // var cupon = parseInt(cupon);
                    var total2 = document.getElementById('total2').value;
                    var total3 = parseInt(total2);
                    var descuento = document.getElementById('desc').value;

                    if(descuento == '' || isNaN(descuento) || descuento == null){
                        descuento = 0;
                    }

                    var descuento1 = parseInt(descuento);
                    var propina = document.getElementById('propina').value;

                    if(propina == '' || isNaN(propina) || propina == null){
                        propina = 0;
                    }

                    var propina1 = parseInt(propina);
                    var tres = document.getElementById('tres').value;
                    var tres1 = parseInt(tres);
                    var motivoDescuento = document.getElementById('motivoDescuento').value;
                    var desUser = document.getElementById('userDescuento').value;
                    var desU = parseInt(desUser);
                    var formaPago = document.getElementById('forma_pago').value;
                } else {
                    var mesaTitulo = $('#id_proveedor').val();
                    var tcomanda = document.getElementById('total1').value;
                    var tcomanda = parseInt(tcomanda);
                    // var cupon = document.getElementById('cupon').value;
                    // var cupon = parseInt(cupon);
                    var total2 = document.getElementById('total2').value;
                    var total3 = parseInt(total2);
                    var dos = document.getElementById('dos').value;
                    var dos1 = parseInt(dos);
                    var tres = document.getElementById('tres').value;
                    var tres1 = parseInt(tres);
                    var formaPago = document.getElementById('forma_pago').value;
                }


                if ($('#reducir').val() != 'No') {
                    if (formaPago.trim() == '' || formaPago == 0) {
                        $('#lbpago').html("<span style='color:red;'>Seleccione una opción</span>");
                        $('#forma_pago').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Seleccion una opción, verifique sus datos!',
                        })
                        return false;
                    // } else if (cupon == null || isNaN(cupon)) {
                    //     $('#lbcupon').html("<span style='color:red;'>El valor es incorrecto</span>");
                    //     $('#cupon').focus();
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'Error el valor es incorrecto, verifique sus datos!',
                    //     })
                    //     return false;
                    } else if (total3 == null || isNaN(total3)) {
                        $('#lbtotal2').html(
                            "<span style='color:red;'>El total no puede ser menor al subtotal</span>");
                        $('#total2').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el total no puede ser menor al subtotal, verifique sus datos!',
                        })
                        return false;
                    } else if (dos1 == null || isNaN(dos1)) {
                        $('#lbdos').html("<span style='color:red;'>El pago es incorrecto</span>");
                        $('#dos').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el pago es incorrecto, ingrese un valor válido!',
                        })
                        return false;
                    } else if (tres1 == null || isNaN(tres1)) {
                        $('#lbtres').html("<span style='color:red;'>El valor es incorrecto</span>");
                        $('#tres').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el valor es incorrecto, verifique sus datos!',
                        })
                        return false;
                    } else {

                        Swal.fire({
                            title: 'Está seguro que desea pagar la mesa?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sí!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('ComandaHome.store') }}",
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        console.log(data);
                                        location.reload();
                                        window.open('/ticket', 'width=1000,height=800');
                                        //location.reload();
                                    },
                                    error: function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido guardar 6!',
                                        })
                                    }
                                });
                                // $('#cupon').val("");
                                $('#conftotal').val("");
                                $('#desc').val("");
                                $('#res').val("");
                                $('#propina').val("");
                                $('#total2').val("");
                                $('#dos').val("");
                                $('#tres').val("");

                                $("#total").html("$" + "0.00");
                                $('#total1').val("");
                                $('#id_proveedor').val("");
                                $('#incrementa').val("0");
                                $("#direccion").val("");
                                $("#cliente").val("");
                                $('#valor').val("0");
                                $("#comentario").val("");
                                $("#motivoDescuento").val("");

                                $("#consumo").hide();
                                $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                                $("#motivoDescuento").hide();

                                var resultados = document.getElementById('detalle1');
                                resultados.innerHTML = '';
                                var detalleTotal = document.getElementById('total');
                                detalleTotal.innerHTML = '';
                                var lbtotal = document.getElementById('total');
                                lbtotal.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbpago = document.getElementById('lbpago');
                                lbpago.innerHTML = '';

                                $("#lbcupon").hide();
                                $("#lbconf_total").hide();
                                $("#lbdesc").hide();
                                $("#lbres").hide();
                                $("#lbpropina").hide();
                                $("#lbtotal2").hide();
                                $("#lbdos").hide();
                                $("#lbtres").hide();
                                $("#lbpago").hide();

                                Swal.fire(
                                    'Pagado!',
                                    'Orden finalizada, ' + mesaTitulo + ' disponible.',
                                    'success'
                                )
                                var data = {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    "tituloMesa": mesaTitulo
                                };
                                $.ajax({
                                    url: "/estadoHome",
                                    type: "POST",
                                    data: data,
                                    sucess: function (msg) {
                                        console.log(msg);
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });

                                var elementos = document.getElementsByName("titulo_mesa2");
                                var estados = document.getElementsByName("estado_mesa2");
                                for (y = 0; y < elementos.length; y++) {
                                    j = y + 1;
                                    if (elementos[y].value == mesaTitulo) {
                                        document.getElementsByTagName('tr')[j].getElementsByTagName(
                                            'td')[1].setAttribute("style",
                                            "background-color:#008000;");
                                        document.getElementsByTagName("button")[j].setAttribute(
                                            "style", "background-color:#FFFFFF;");
                                        document.getElementsByTagName("button")[j].disabled = false;
                                        document.getElementsByTagName("button")[j].innerHTML =
                                            "Abrir mesa";
                                        estados[y].value = "Cerrada";
                                        document.getElementsByName("estado_mesa2")[y].value =
                                            "Cerrada";
                                        document.getElementsByTagName("label")[y].style.display =
                                            'none';
                                    } else if (elementos[y].value != mesaTitulo) {
                                        document.getElementsByTagName("button")[j].disabled = false;
                                    }
                                }
                                //location.reload();
                            }

                        })
                    }

                } else {
                    if (formaPago.trim() == '' || formaPago == 0) {
                        $('#lbpago').html("<span style='color:red;'>Seleccione una opción</span>");
                        $('#forma_pago').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Seleccion una opción, verifique sus datos!',
                        })
                        return false;
                    } else if (conftotal < tot || conftotal > tot || isNaN(conftotal)) {
                        $('#lbconf_total').html(
                            "<span style='color:red;'>El importe debe ser igual al total</span>");
                        $('#conftotal').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el importe debe ser igual al total, ingrese el importe!',
                        })
                        return false;
                    // } else if (descuento1 == null || isNaN(descuento1) || descuento1 > desU) {
                    //     $('#lbdesc').html(
                    //         "<span style='color:red;'>El descuento es incorrecto, el límite del descuento es " +
                    //         desU + "%</span>");
                    //     $('#desc').focus();
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'Error ingrese un valor numérico valido, el límite del descuento es ' +
                    //             desU + '%, ingrese el descuento!',
                    //     })
                    //     return false;
                    } else if (descuento1 > 0 && motivoDescuento == '') {
                        $('#lbmotivoDescuento').html(
                            "<span style='color:red;'>Ingrese el motivo del descuento</span>");
                        $('#motivoDescuento').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el motivo es obligatorio, ingrese el motivo del descuento!',
                        })
                        return false;
                    } else if (res1 == 0 || res1 == null || isNaN(res1)) {
                        $('#lbres').html(
                            "<span style='color:red;'>El subtotal no puede ser menor al importe</span>");
                        $('#res').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el subtotal no puede ser menor al importe, verifique sus datos!',
                        })
                        return false;
                    // } else if (propina1 == null || isNaN(propina1)) {
                    //     $('#lbpropina').html("<span style='color:red;'>Ingrese un valor numérico</span>");
                    //     $('#propina').focus();
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'Error ingrese un valor numérico, ingrese la propina!',
                    //     })
                    //     return false;
                    } else if (total3 == null || isNaN(total3)) {
                        $('#lbtotal2').html(
                            "<span style='color:red;'>El total no puede ser menor al subtotal</span>");
                        $('#total2').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el total no puede ser menor al subtotal, verifique sus datos!',
                        })
                        return false;
                    } else if (dos1 == null || isNaN(dos1)) {
                        $('#lbdos').html("<span style='color:red;'>El pago es incorrecto</span>");
                        $('#dos').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el pago es incorrecto, ingrese un valor válido!',
                        })
                        return false;
                    } else if (tres1 == null || isNaN(tres1)) {
                        $('#lbtres').html("<span style='color:red;'>El valor es incorrecto</span>");
                        $('#tres').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el valor es incorrecto, verifique sus datos!',
                        })
                        return false;
                    } else {

                        Swal.fire({
                            title: 'Está seguro que desea pagar la mesa?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sí!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('ComandaHome.store') }}",
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        console.log(data);
                                        location.reload();
                                        window.open('/ticket', 'width=1000,height=800');
                                        //$('#sample_venta').submit();
                                        //location.reload();
                                    },
                                    error: function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido guardar 7!',
                                        })
                                    }
                                });

                                // $('#cupon').val("");
                                $('#conftotal').val("");
                                $('#desc').val("");
                                $('#res').val("");
                                $('#propina').val("");
                                $('#total2').val("");
                                $('#dos').val("");
                                $('#tres').val("");

                                $("#total").html("$" + "0.00");
                                $('#total1').val("");
                                $('#id_proveedor').val("");
                                $('#incrementa').val("0");
                                $("#direccion").val("");
                                $("#cliente").val("");
                                $('#valor').val("0");
                                $("#comentario").val("");
                                $("#motivoDescuento").val("");

                                $("#consumo").hide();
                                $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                                $("#motivoDescuento").hide();

                                var resultados = document.getElementById('detalle1');
                                resultados.innerHTML = '';
                                var detalleTotal = document.getElementById('total');
                                detalleTotal.innerHTML = '';
                                var lbtotal = document.getElementById('total');
                                lbtotal.innerHTML = '';

                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbconf_total = document.getElementById('lbconf_total');
                                lbconf_total.innerHTML = '';
                                var lbdesc = document.getElementById('lbdesc');
                                lbdesc.innerHTML = '';
                                var lbres = document.getElementById('lbres');
                                lbres.innerHTML = '';
                                var lbpropina = document.getElementById('lbpropina');
                                lbpropina.innerHTML = '';
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbmotivoDescuento = document.getElementById(
                                    'lbmotivoDescuento');
                                lbmotivoDescuento.innerHTML = '';
                                var lbcomentario = document.getElementById('lbcomentario');
                                lbcomentario.innerHTML = '';
                                var lbpago = document.getElementById('lbpago');
                                lbpago.innerHTML = '';

                                $("#lbcupon").hide();
                                $("#lbconf_total").hide();
                                $("#lbdesc").hide();
                                $("#lbres").hide();
                                $("#lbpropina").hide();
                                $("#lbtotal2").hide();
                                $("#lbdos").hide();
                                $("#lbtres").hide();
                                $("#lbpago").hide();

                                Swal.fire(
                                    'Pagado!',
                                    'Orden finalizada, ' + mesaTitulo + ' disponible.',
                                    'success'
                                )
                                var data = {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    "tituloMesa": mesaTitulo
                                };
                                $.ajax({
                                    url: "/estadoHome",
                                    type: "POST",
                                    data: data,
                                    sucess: function (msg) {
                                        console.log(msg);
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });

                                var elementos = document.getElementsByName("titulo_mesa2");
                                var estados = document.getElementsByName("estado_mesa2");
                                for (y = 0; y < elementos.length; y++) {
                                    j = y + 1;
                                    if (elementos[y].value == mesaTitulo) {
                                        document.getElementsByTagName('tr')[j].getElementsByTagName(
                                            'td')[1].setAttribute("style",
                                            "background-color:#008000;");
                                        document.getElementsByTagName("button")[j].setAttribute(
                                            "style", "background-color:#FFFFFF;");
                                        document.getElementsByTagName("button")[j].disabled = false;
                                        document.getElementsByTagName("button")[j].innerHTML =
                                            "Abrir mesa";
                                        estados[y].value = "Cerrada";
                                        document.getElementsByName("estado_mesa2")[y].value =
                                            "Cerrada";
                                        document.getElementsByTagName("label")[y].style.display =
                                            'none';
                                    } else if (elementos[y].value != mesaTitulo) {
                                        document.getElementsByTagName("button")[j].disabled = false;
                                    }
                                }
                                //location.reload();
                            }

                        })
                    }

                }

            });

            $('.hotelConsumo').click(function () {
                if ($('#reducir').val() != 'Si') {
                    var mesaTitulo = $('#id_proveedor').val();
                    var conftotal = document.getElementById('conftotal').value;
                    var total = document.getElementById('total');
                    var total1 = total.innerHTML;
                    var cadena = total1.substring(1);
                    var tot = parseInt(cadena);
                    var res = document.getElementById('res').value;
                    var res1 = parseInt(res);
                    var dos = document.getElementById('dos').value;
                    var dos1 = parseInt(dos);
                    var tcomanda = document.getElementById('total1').value;
                    var tcomanda = parseInt(tcomanda);
                    // var cupon = document.getElementById('cupon').value;
                    // var cupon = parseInt(cupon);
                    var total2 = document.getElementById('total2').value;
                    var total3 = parseInt(total2);
                    var descuento = document.getElementById('desc').value;
                    var descuento1 = parseInt(descuento);
                    var propina = document.getElementById('propina').value;
                    var propina1 = parseInt(propina);
                    var tres = document.getElementById('tres').value;
                    var tres1 = parseInt(tres);
                    var motivoDescuento = document.getElementById('motivoDescuento').value;
                    var desUser = document.getElementById('userDescuento').value;
                    var desU = parseInt(desUser);
                    var formaPago = document.getElementById('forma_pago').value;
                    var habitacion = document.getElementById('habitacion').value;
                } else {
                    var mesaTitulo = $('#id_proveedor').val();
                    var tcomanda = document.getElementById('total1').value;
                    var tcomanda = parseInt(tcomanda);
                    // var cupon = document.getElementById('cupon').value;
                    // var cupon = parseInt(cupon);
                    var total2 = document.getElementById('total2').value;
                    var total3 = parseInt(total2);
                    var dos = document.getElementById('dos').value;
                    var dos1 = parseInt(dos);
                    var tres = document.getElementById('tres').value;
                    var tres1 = parseInt(tres);
                    var formaPago = document.getElementById('forma_pago').value;
                    var habitacion = document.getElementById('habitacion').value;
                }


                if ($('#reducir').val() != 'No') {
                    if (habitacion.trim() == '' || habitacion == 0) {
                        $('#lbhabitacion').html("<span style='color:red;'>Seleccione una opción</span>");
                        $('#habitacion').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Seleccion una opción, verifique sus datos!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            title: 'Está seguro que desea agregar la mesa a consumo?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sí!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('ComandaHome.guardarConsumo') }}",
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        console.log(data);
                                        location.reload();
                                        //window.open('/ticket','width=1000,height=800');
                                        //location.reload();
                                    },
                                    error: function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido guardar 8!',
                                        })
                                    }
                                });
                                // $('#cupon').val("");
                                $('#conftotal').val("");
                                $('#desc').val("");
                                $('#res').val("");
                                $('#propina').val("");
                                $('#total2').val("");
                                $('#dos').val("");
                                $('#tres').val("");

                                $("#total").html("$" + "0.00");
                                $('#total1').val("");
                                $('#id_proveedor').val("");
                                $('#incrementa').val("0");
                                $("#direccion").val("");
                                $("#cliente").val("");
                                $('#valor').val("0");
                                $("#comentario").val("");
                                $("#motivoDescuento").val("");

                                $("#consumo").hide();
                                $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                                $("#motivoDescuento").hide();

                                var resultados = document.getElementById('detalle1');
                                resultados.innerHTML = '';
                                var detalleTotal = document.getElementById('total');
                                detalleTotal.innerHTML = '';
                                var lbtotal = document.getElementById('total');
                                lbtotal.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbpago = document.getElementById('lbpago');
                                lbpago.innerHTML = '';

                                $("#lbcupon").hide();
                                $("#lbconf_total").hide();
                                $("#lbdesc").hide();
                                $("#lbres").hide();
                                $("#lbpropina").hide();
                                $("#lbtotal2").hide();
                                $("#lbdos").hide();
                                $("#lbtres").hide();
                                $("#lbpago").hide();

                                Swal.fire(
                                    'Agregado a consumo!',
                                    'Orden finalizada, ' + mesaTitulo + ' disponible.',
                                    'success'
                                )
                                var data = {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    "tituloMesa": mesaTitulo
                                };
                                $.ajax({
                                    url: "/estadoHome",
                                    type: "POST",
                                    data: data,
                                    sucess: function (msg) {
                                        console.log(msg);
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });

                                var elementos = document.getElementsByName("titulo_mesa2");
                                var estados = document.getElementsByName("estado_mesa2");
                                for (y = 0; y < elementos.length; y++) {
                                    j = y + 1;
                                    if (elementos[y].value == mesaTitulo) {
                                        document.getElementsByTagName('tr')[j].getElementsByTagName(
                                            'td')[1].setAttribute("style",
                                            "background-color:#008000;");
                                        document.getElementsByTagName("button")[j].setAttribute(
                                            "style", "background-color:#FFFFFF;");
                                        document.getElementsByTagName("button")[j].disabled = false;
                                        document.getElementsByTagName("button")[j].innerHTML =
                                            "Abrir mesa";
                                        estados[y].value = "Cerrada";
                                        document.getElementsByName("estado_mesa2")[y].value =
                                            "Cerrada";
                                        document.getElementsByTagName("label")[y].style.display =
                                            'none';
                                    } else if (elementos[y].value != mesaTitulo) {
                                        document.getElementsByTagName("button")[j].disabled = false;
                                    }
                                }
                                //location.reload();
                            }

                        })

                    }
                } else {
                    if (habitacion.trim() == '' || habitacion == 0) {
                        $('#lbhabitacion').html("<span style='color:red;'>Seleccione una opción</span>");
                        $('#habitacion').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Seleccion una opción, verifique sus datos!',
                        })
                        return false;
                    } else {
                        Swal.fire({
                            title: 'Está seguro que desea agregar la mesa a consumo?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sí!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('ComandaHome.guardarConsumo') }}",
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        console.log(data);
                                        location.reload();
                                        //window.open('/ticket','width=1000,height=800');
                                        //location.reload();
                                    },
                                    error: function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido guardar 9!',
                                        })
                                    }
                                });

                                // $('#cupon').val("");
                                $('#conftotal').val("");
                                $('#desc').val("");
                                $('#res').val("");
                                $('#propina').val("");
                                $('#total2').val("");
                                $('#dos').val("");
                                $('#tres').val("");

                                $("#total").html("$" + "0.00");
                                $('#total1').val("");
                                $('#id_proveedor').val("");
                                $('#incrementa').val("0");
                                $("#direccion").val("");
                                $("#cliente").val("");
                                $('#valor').val("0");
                                $("#comentario").val("");
                                $("#motivoDescuento").val("");

                                $("#consumo").hide();
                                $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                                $("#motivoDescuento").hide();

                                var resultados = document.getElementById('detalle1');
                                resultados.innerHTML = '';
                                var detalleTotal = document.getElementById('total');
                                detalleTotal.innerHTML = '';
                                var lbtotal = document.getElementById('total');
                                lbtotal.innerHTML = '';

                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbconf_total = document.getElementById('lbconf_total');
                                lbconf_total.innerHTML = '';
                                var lbdesc = document.getElementById('lbdesc');
                                lbdesc.innerHTML = '';
                                var lbres = document.getElementById('lbres');
                                lbres.innerHTML = '';
                                var lbpropina = document.getElementById('lbpropina');
                                lbpropina.innerHTML = '';
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbmotivoDescuento = document.getElementById(
                                    'lbmotivoDescuento');
                                lbmotivoDescuento.innerHTML = '';
                                var lbcomentario = document.getElementById('lbcomentario');
                                lbcomentario.innerHTML = '';
                                var lbpago = document.getElementById('lbpago');
                                lbpago.innerHTML = '';

                                $("#lbcupon").hide();
                                $("#lbconf_total").hide();
                                $("#lbdesc").hide();
                                $("#lbres").hide();
                                $("#lbpropina").hide();
                                $("#lbtotal2").hide();
                                $("#lbdos").hide();
                                $("#lbtres").hide();
                                $("#lbpago").hide();

                                Swal.fire(
                                    'Agregado a consumo!',
                                    'Orden finalizada, ' + mesaTitulo + ' disponible.',
                                    'success'
                                )
                                var data = {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    "tituloMesa": mesaTitulo
                                };
                                $.ajax({
                                    url: "/estadoHome",
                                    type: "POST",
                                    data: data,
                                    sucess: function (msg) {
                                        console.log(msg);
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });

                                var elementos = document.getElementsByName("titulo_mesa2");
                                var estados = document.getElementsByName("estado_mesa2");
                                for (y = 0; y < elementos.length; y++) {
                                    j = y + 1;
                                    if (elementos[y].value == mesaTitulo) {
                                        document.getElementsByTagName('tr')[j].getElementsByTagName(
                                            'td')[1].setAttribute("style",
                                            "background-color:#008000;");
                                        document.getElementsByTagName("button")[j].setAttribute(
                                            "style", "background-color:#FFFFFF;");
                                        document.getElementsByTagName("button")[j].disabled = false;
                                        document.getElementsByTagName("button")[j].innerHTML =
                                            "Abrir mesa";
                                        estados[y].value = "Cerrada";
                                        document.getElementsByName("estado_mesa2")[y].value =
                                            "Cerrada";
                                        document.getElementsByTagName("label")[y].style.display =
                                            'none';
                                    } else if (elementos[y].value != mesaTitulo) {
                                        document.getElementsByTagName("button")[j].disabled = false;
                                    }
                                }
                                //location.reload();
                            }

                        })
                    }
                }

            });
        });

    </script>

    {{--Selects Dinamicos--}}
    <script>
        $(document).ready(function () {

            var rsubcategoria = $('#rsubcategoria').val();

            if (rsubcategoria != 'Si') {
                console.log($('#select_categoria').val());
                $('#select_categoria').on('change', function () {
                    var id_categoria = $('#select_categoria').val();
                    console.log(id_categoria);
                    $.ajax({
                        url: "/productos/" + id_categoria,
                        type: "GET",
                        dataType: "json",
                        error: function (element) {
                            //console.log(element);
                        },
                        success: function (respuesta) {
                            $("#producto").html(
                                '<option value="" selected="true"> Seleccione una opción </option>'
                            );
                            respuesta.forEach(element => {
                                $('#producto').append('<option value=' + element.id +
                                    '> ' + element.titulo + ' </option>')
                            });
                        }
                    });
                });
            } else {

                $('#select_categoria').on('change', function () {
                    var id_categoria = $('#select_categoria').val();

                    $.ajax({
                        url: "/subcategory/" + id_categoria,
                        type: "GET",
                        dataType: "json",
                        error: function (element) {
                            //console.log(element);
                        },
                        success: function (respuesta) {
                            $("#select_subcategoria").html(
                                '<option value="" selected="true"> Seleccione una opción </option>'
                            );
                            respuesta.forEach(element => {
                                $('#select_subcategoria').append('<option value=' +
                                    element.id + '> ' + element.titulo +
                                    ' </option>')
                            });
                        }
                    });
                });

                $('#select_subcategoria').on('change', function () {
                    var id_categoria = $('#select_subcategoria').val();

                    $.ajax({
                        url: "/productos/" + id_categoria,
                        type: "GET",
                        dataType: "json",
                        error: function (element) {
                            //console.log(element);
                        },
                        success: function (respuesta) {
                            $("#producto").html(
                                '<option value="" selected="true"> Seleccione una opción </option>'
                            );
                            respuesta.forEach(element => {
                                $('#producto').append('<option value=' + element.id +
                                    '> ' + element.titulo + ' </option>')
                            });
                        }
                    });
                });
            }

            $('#producto').on('change', function () {
                var id_producto = $('#producto').val();
                $.ajax({
                    url: "/precio/" + id_producto,
                    type: "GET",
                    dataType: "json",
                    error: function (element) {},
                    success: function (respuesta) {
                        $("#pprecio_compra").val(respuesta.precio);
                        $('#pid_articulo').val(respuesta.titulo);
                    }
                });
            });
            //console.log(rsubcategoria);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- Mesa 2 - Abrir Mesa --}}
    <script>
        setTimeout(function(){
            function syncWIthApis2(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.mesabtn').click(function (e) {
                    e.preventDefault();
                    localStorage.setItem("tableOrden", '');
                    var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                    var idt = $(this).closest("tr").find('.id_mesa').val();
                    var i = idt;
                    var k = idt - 1;

                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';
                    var lbcliente = document.getElementById('lbcliente');
                    lbcliente.innerHTML = '';
                    var lbdireccion = document.getElementById('lbdireccion');
                    lbdireccion.innerHTML = '';

                    // Swal.fire({
                    //     title: 'Está seguro que desea abrir la mesa?',
                    //     text: "¡No podrás revertir esto!",
                    //     icon: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#3085d6',
                    //     cancelButtonColor: '#d33',
                    //     cancelButtonText: 'Cancelar',
                    //     confirmButtonText: 'Sí!'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {

                            var resultados = document.getElementById('detalle1');
                            resultados.innerHTML = '';
                            var detalleTotal = document.getElementById('total');
                            detalleTotal.innerHTML = '';

                            if ($('#reducir').val() != 'Si') {

                                var lbconf_total = document.getElementById('lbconf_total');
                                lbconf_total.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdesc = document.getElementById('lbdesc');
                                lbdesc.innerHTML = '';
                                var lbres = document.getElementById('lbres');
                                lbres.innerHTML = '';
                                var lbpropina = document.getElementById('lbpropina');
                                lbpropina.innerHTML = '';
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                                lbmotivoDescuento.innerHTML = '';
                                var lbcomentario = document.getElementById('lbcomentario');
                                lbcomentario.innerHTML = '';
                            } else {
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                            }

                            $('#total1').val("");
                            $("#total").html(" ");
                            $("#total").html("$" + "0.00");
                            $('#valor').val("0");
                            $('#incrementa').val("0");
                            $("#comentario").val("");

                            // $('#cupon').val("");
                            $('#conftotal').val("");
                            $('#desc').val("");
                            $('#res').val("");
                            $('#propina').val("");
                            $('#total2').val("");
                            $('#dos').val("");
                            $('#tres').val("");
                            $('#motivoDescuento').val("");

                            $('#id_proveedor').val(tituloMesa);
                            $('#mesa_estado').val('Abierta');
                            var mesa = $('#id_proveedor').val();

                            if (mesa.trim() == 'Para llevar') {
                                $("#cliente").show();
                                $("#direccion").show();
                                $("#clientelb").show();
                                $("#direccionlb").show();
                            } else {
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                                $("#cliente").val("");
                                $("#direccion").val("");
                            }


                            document.getElementsByTagName("button")[i].innerHTML = "Atendiendo";
                            document.getElementsByTagName("button")[i].setAttribute("style",
                                "background-color:#C0C0C0;");
                            document.getElementsByTagName("button")[i].disabled = true;
                            document.getElementsByTagName('tr')[i].getElementsByTagName('td')[1]
                                .setAttribute("style", "background-color:#ce0018;");

                            //Console.log(i+"hola prueba");
                            document.getElementsByTagName("button")[i].addEventListener("click",
                                cambiar);
                            document.getElementsByTagName("figure")[k].style.display = 'block';




                            function cambiar() {
                                var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                                var estadoMesa = $(this).closest("tr").find('.estado_mesa2').val();
                                var idt = $(this).closest("tr").find('.id_mesa').val();

                                var contador = 0;
                                var evaluar = 0;
                                var total = 0;
                                var suma = 0;
                                var base = 0;
                                var dato = 0;
                                var k = idt - 1;
                                var f = 0;

                                var lbmesa = document.getElementById('lbmesa');
                                lbmesa.innerHTML = '';
                                var lbprecio_compra = document.getElementById('lbprecio_compra');
                                lbprecio_compra.innerHTML = '';
                                var lbcantidad = document.getElementById('lbcantidad');
                                lbcantidad.innerHTML = '';
                                var lbpespecial = document.getElementById('lbpespecial');
                                lbpespecial.innerHTML = '';
                                var lbpesprecio = document.getElementById('lbpesprecio');
                                lbpesprecio.innerHTML = '';
                                var lbpespcant = document.getElementById('lbpespcant');
                                lbpespcant.innerHTML = '';
                                var lbcliente = document.getElementById('lbcliente');
                                lbcliente.innerHTML = '';
                                var lbdireccion = document.getElementById('lbdireccion');
                                lbdireccion.innerHTML = '';

                                // Swal.fire({
                                //     title: 'Está seguro que desea ver la mesa?',
                                //     text: "¡No podrás revertir esto!",
                                //     icon: 'warning',
                                //     showCancelButton: true,
                                //     confirmButtonColor: '#3085d6',
                                //     cancelButtonColor: '#d33',
                                //     cancelButtonText: 'Cancelar',
                                //     confirmButtonText: 'Sí!'
                                // }).then((result) => {
                                    // if (result.isConfirmed) {

                                        if ($('#reducir').val() != 'Si') {
                                            var lbconf_total = document.getElementById(
                                                'lbconf_total');
                                            lbconf_total.innerHTML = '';
                                            var lbcupon = document.getElementById('lbcupon');
                                            lbcupon.innerHTML = '';
                                            var lbdesc = document.getElementById('lbdesc');
                                            lbdesc.innerHTML = '';
                                            var lbres = document.getElementById('lbres');
                                            lbres.innerHTML = '';
                                            var lbpropina = document.getElementById(
                                                'lbpropina');
                                            lbpropina.innerHTML = '';
                                            var lbtotal2 = document.getElementById('lbtotal2');
                                            lbtotal2.innerHTML = '';
                                            var lbdos = document.getElementById('lbdos');
                                            lbdos.innerHTML = '';
                                            var lbtres = document.getElementById('lbtres');
                                            lbtres.innerHTML = '';
                                            var lbmotivoDescuento = document.getElementById(
                                                'lbmotivoDescuento');
                                            lbmotivoDescuento.innerHTML = '';
                                            var lbcomentario = document.getElementById(
                                                'lbcomentario');
                                            lbcomentario.innerHTML = '';
                                        } else {
                                            var lbtotal2 = document.getElementById('lbtotal2');
                                            lbtotal2.innerHTML = '';
                                            var lbcupon = document.getElementById('lbcupon');
                                            lbcupon.innerHTML = '';
                                            var lbdos = document.getElementById('lbdos');
                                            lbdos.innerHTML = '';
                                            var lbtres = document.getElementById('lbtres');
                                            lbtres.innerHTML = '';
                                        }

                                        // $('#cupon').val("");
                                        $('#conftotal').val("");
                                        $('#desc').val("");
                                        $('#res').val("");
                                        $('#propina').val("");
                                        $('#total2').val("");
                                        $('#dos').val("");
                                        $('#tres').val("");
                                        $('#motivoDescuento').val("");

                                        $('#id_proveedor').val(tituloMesa);
                                        $('#mesa_estado').val(estadoMesa);
                                        var mesa = $('#id_proveedor').val();
                                        document.getElementsByTagName("figure")[k].style
                                            .display = 'block';

                                        if (mesa.trim() == 'Para llevar') {
                                            $("#cliente").show();
                                            $("#direccion").show();
                                            $("#clientelb").show();
                                            $("#direccionlb").show();
                                        } else {
                                            $("#cliente").hide();
                                            $("#direccion").hide();
                                            $("#clientelb").hide();
                                            $("#direccionlb").hide();
                                            $("#cliente").val("");
                                            $("#direccion").val("");
                                        }

                                        $.ajax({
                                            url: "/obtenerComanda/" + mesa,
                                            type: "GET",
                                            dataType: "json",
                                            success: function (data) {

                                                data.forEach(function (element,
                                                    indice, array) {
                                                    var articulo = element
                                                        .articulo;

                                                    if (articulo != null) {
                                                        $('#detalles')
                                                            .append(
                                                                '<tr class="selected" id="fila' +
                                                                element
                                                                .fila +
                                                                '">' +
                                                                '<td><button type="button"  class="btn btn-warning" onclick="eliminar(' +
                                                                element
                                                                .fila +
                                                                ',' +
                                                                element
                                                                .subtotal +
                                                                ')">Eliminar</button></td>' +
                                                                '<td><input type="hidden" name="articulo[]" value="' +
                                                                element
                                                                .articulo +
                                                                '">' +
                                                                element
                                                                .articulo +
                                                                '</td>' +
                                                                '<td><input type="hidden" name="cantidad[]" value="' +
                                                                element
                                                                .cantidad +
                                                                '">' +
                                                                element
                                                                .cantidad +
                                                                '</td>' +
                                                                '<td><input type="hidden" name="precio_compra[]" value="' +
                                                                element
                                                                .precio_compra +
                                                                '">' +
                                                                element
                                                                .precio_compra +
                                                                '</td>' +
                                                                '<td><input type="hidden" name="subtotal[]" value="' +
                                                                element
                                                                .subtotal +
                                                                '">' +
                                                                element
                                                                .subtotal +
                                                                '</td>' +
                                                                '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                                                                element
                                                                .fila +
                                                                '"></td></tr>'
                                                            )

                                                        total += parseFloat(
                                                            element
                                                            .subtotal);
                                                        base = total
                                                            .toFixed(2);

                                                        var cliente =
                                                            element.cliente;
                                                        var direccion =
                                                            element
                                                            .direccion;
                                                        $('#cliente').val(
                                                            cliente);
                                                        $('#direccion').val(
                                                            direccion);

                                                    } else {

                                                        total = 0;
                                                        base = total
                                                            .toFixed(2);
                                                    }

                                                    var comentario = element
                                                        .comentario;
                                                    if (comentario !=
                                                        null) {
                                                        $('#comentario')
                                                            .val(
                                                                comentario);
                                                    } else {
                                                        $("#comentario")
                                                            .val("");
                                                    }

                                                });

                                                evaluar = parseInt(total);
                                                if (evaluar != 0) {
                                                    $("#total").html("$" + base);
                                                    $('#valor').val(base);
                                                    $('#total1').val(base);
                                                    $('#total2').val(base);
                                                    $("#guardar").show();
                                                    $("#consumo").show();

                                                    var f = data.length - 1;
                                                    var dato = data[f].fila;
                                                    contador = parseInt(dato) + 1;
                                                    $('#incrementa').val(contador);

                                                    function evaluar() {
                                                        if (base > 0) {
                                                            $("#guardar").show();
                                                            $("#consumo").show();
                                                        } else {
                                                            $("#consumo").hide();
                                                            $("#guardar").hide();
                                                            $("#total").html("$" +
                                                                "0.00");
                                                            $('#total1').val("");
                                                        }
                                                    }
                                                } else {
                                                    $('#total1').val("");
                                                    $("#total").html("$" + "0.00");
                                                    $('#valor').val("0");
                                                    $('#incrementa').val("0");
                                                    $("#guardar").hide();
                                                    $("#consumo").hide();
                                                    if (data == '') {
                                                        $("#comentario").val("");
                                                    }
                                                }
                                            },
                                            error: function (error) {
                                                console.log(error);
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error!',
                                                    text: 'No se ha podido obtener la comanda!',
                                                })
                                            }
                                        });

                                        // Swal.fire(
                                        //     'consultada!',
                                        //     'La mesa ha sido consultada.',
                                        //     'success'
                                        // )
                                        var resultados = document.getElementById('detalle1');
                                        resultados.innerHTML = '';
                                        var detalleTotal = document.getElementById('total');
                                        detalleTotal.innerHTML = '';
                                    // } else {
                                    //     Swal.fire('La mesa no ha sido consultada', '', 'info')
                                    // }

                                // })
                            }
                            var j = document.getElementById("tableUserList").rows.length;
                            for (var x = 0; x < j; x++) {
                                document.getElementsByTagName("button")[x].setAttribute("style",
                                    "background-color:#C0C0C0;");
                                document.getElementsByTagName("button")[x].disabled = true;
                            }
                            var elementos = document.getElementsByName("titulo_mesa2");
                            var estados = document.getElementsByName("estado_mesa2");
                            for (y = 0; y < elementos.length; y++) {
                                if (elementos[y].value == mesa) {
                                    estados[y].value = "Abierta";
                                    document.getElementsByName("estado_mesa2")[y].value = "Abierta";
                                }
                            }

                            var data = {
                                "_token": $("meta[name='csrf-token']").attr("content"),
                                "idt": idt,
                                "tituloMesa": tituloMesa
                            };
                            $.ajax({
                                url: "/datosHome",
                                type: "POST",
                                data: data,
                                sucess: function (msg) {
                                    console.log(msg);
                                    location.reload();
                                },
                                error: function (error) {
                                    console.log(error);
                                }

                            });
                    //     } else {
                    //         Swal.fire('La mesa no se ha abierto', '', 'info')
                    //     }

                    // })
                });
            }

            $(document).ready(function () {
                setInterval(syncWIthApis2, 950); //Cada 30 segundo (30 mil milisegundos)
            });

        }, 1500);

    </script>

    {{-- Mesa Proceso al Cerrar --}}
    <script type="text/javascript">
        setTimeout(function(){
            function syncWIthApis3(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.cerrar').click(function (e) {
                    e.preventDefault();

                    var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                    var idt = $(this).closest("tr").find('.id_mesa').val();
                    var k = idt - 1;

                    var fecha = document.getElementById('fecha').value;
                    var mesa = document.getElementById('id_proveedor').value;
                    var estado = document.getElementById('mesa_estado').value;
                    var cajero = document.getElementById('cajero').value;
                    var cliente = document.getElementById('cliente').value;
                    var direccion = document.getElementById('direccion').value;
                    var comentario = document.getElementById('comentario').value;

                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';
                    var lbcliente = document.getElementById('lbcliente');
                    lbcliente.innerHTML = '';
                    var lbdireccion = document.getElementById('lbdireccion');
                    lbdireccion.innerHTML = '';

                    Swal.fire({
                        title: 'Está seguro que desea cerrar la mesa?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        html: '<label for="motivo">Motivo de cancelación</label>' +
                            '<input id="swal-input1" class="swal2-input">',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Sí!',
                        focusConfirm: false,
                        preConfirm: () => {
                            const motivo = Swal.getPopup().querySelector('#swal-input1').value
                            if (!motivo) {
                                Swal.showValidationMessage('Ingresa el motivo')
                            }
                            return {
                                motivo: motivo
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {

                            if ($('#reducir').val() != 'Si') {
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbconf_total = document.getElementById('lbconf_total');
                                lbconf_total.innerHTML = '';
                                var lbdesc = document.getElementById('lbdesc');
                                lbdesc.innerHTML = '';
                                var lbres = document.getElementById('lbres');
                                lbres.innerHTML = '';
                                var lbpropina = document.getElementById('lbpropina');
                                lbpropina.innerHTML = '';
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                                lbmotivoDescuento.innerHTML = '';
                                var lbcomentario = document.getElementById('lbcomentario');
                                lbcomentario.innerHTML = '';
                            } else {
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                            }

                            // $('#cupon').val("");
                            $('#conftotal').val("");
                            $('#desc').val("");
                            $('#res').val("");
                            $('#propina').val("");
                            $('#total2').val("");
                            $('#dos').val("");
                            $('#tres').val("");
                            $('#motivoDescuento').val("");

                            var estadoMesa = $(this).closest("tr").find('.estado_mesa2').val();
                            var motivo = document.getElementById('swal-input1').value;
                            $('#motivo').val(motivo);

                            var data = {
                                "_token": $("meta[name='csrf-token']").attr("content"),
                                "idt": idt,
                                "tituloMesa": tituloMesa,
                                "motivo": motivo,
                                "estadoMesa": estadoMesa
                            };
                            $.ajax({
                                url: "/cerrarMesa",
                                type: "POST",
                                data: data,
                                sucess: function (msg) {
                                    console.log(msg);
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });

                            if ($('#id_proveedor').val() == tituloMesa) {
                                $.ajax({
                                    url: "/ordenCancelada",
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        console.log(data);
                                    },
                                    error: function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido guardar X!',
                                        })
                                    }
                                });
                            }

                            var mesa = $('#id_proveedor').val();
                            document.getElementsByTagName("figure")[k].style.display = 'none';

                            document.getElementsByTagName('tr')[idt].getElementsByTagName('td')[1]
                                .setAttribute("style", "background-color:#008000;");
                            document.getElementsByTagName("button")[idt].setAttribute("style",
                                "background-color:#FFFFFF;");
                            document.getElementsByTagName("button")[idt].disabled = false;
                            document.getElementsByTagName("button")[idt].innerHTML = "Abrir mesa";
                            document.getElementsByTagName("button")[idt].addEventListener("click",
                                cambiar);

                            var j = document.getElementById("tableUserList").rows.length;
                            for (var x = 0; x < j; x++) {
                                document.getElementsByTagName("button")[x].setAttribute("style",
                                    "background-color:#FFFFFF;");
                                document.getElementsByTagName("button")[x].disabled = false;
                            }

                            var elementos = document.getElementsByName("titulo_mesa2");
                            var estados = document.getElementsByName("estado_mesa2");
                            for (y = 0; y < elementos.length; y++) {
                                if (elementos[y].value == tituloMesa) {
                                    estados[y].value = "Cerrada";
                                    document.getElementsByName("estado_mesa2")[y].value = "Cerrada";
                                } else if (elementos[k].value == tituloMesa) {
                                    estados[k].value = "Cerrada";
                                    document.getElementsByName("estado_mesa2")[k].value = "Cerrada";
                                    //document.getElementsByTagName("label")[k].style.display = 'none';
                                }
                            }


                            if (tituloMesa == mesa) {
                                var resultados = document.getElementById('detalle1');
                                resultados.innerHTML = '';
                                var detalleTotal = document.getElementById('total');
                                detalleTotal.innerHTML = '';

                                if ($('#reducir').val() != 'Si') {
                                    var lbconf_total = document.getElementById('lbconf_total');
                                    lbconf_total.innerHTML = '';
                                    var lbcupon = document.getElementById('lbcupon');
                                    lbcupon.innerHTML = '';
                                    var lbdesc = document.getElementById('lbdesc');
                                    lbdesc.innerHTML = '';
                                    var lbres = document.getElementById('lbres');
                                    lbres.innerHTML = '';
                                    var lbpropina = document.getElementById('lbpropina');
                                    lbpropina.innerHTML = '';
                                    var lbtotal2 = document.getElementById('lbtotal2');
                                    lbtotal2.innerHTML = '';
                                    var lbdos = document.getElementById('lbdos');
                                    lbdos.innerHTML = '';
                                    var lbtres = document.getElementById('lbtres');
                                    lbtres.innerHTML = '';
                                    var lbmotivoDescuento = document.getElementById(
                                        'lbmotivoDescuento');
                                    lbmotivoDescuento.innerHTML = '';
                                    var lbcomentario = document.getElementById('lbcomentario');
                                    lbcomentario.innerHTML = '';
                                } else {
                                    var lbtotal2 = document.getElementById('lbtotal2');
                                    lbtotal2.innerHTML = '';
                                    var lbcupon = document.getElementById('lbcupon');
                                    lbcupon.innerHTML = '';
                                    var lbdos = document.getElementById('lbdos');
                                    lbdos.innerHTML = '';
                                    var lbtres = document.getElementById('lbtres');
                                    lbtres.innerHTML = '';
                                }

                                // $('#cupon').val("");
                                $('#conftotal').val("");
                                $('#desc').val("");
                                $('#res').val("");
                                $('#propina').val("");
                                $('#total2').val("");
                                $('#dos').val("");
                                $('#tres').val("");
                                $('#motivoDescuento').val("");

                                $('#total1').val("");
                                $("#total").html("$" + "0.00");
                                $('#id_proveedor').val("");
                                $('#incrementa').val("0");
                                $("#direccion").val("");
                                $("#cliente").val("");
                                $('#valor').val("0");
                                $("#comentario").val("");

                                $("#consumo").hide();
                                $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                            }

                            function cambiar() {
                                var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                                var idt = $(this).closest("tr").find('.id_mesa').val();
                                var total = 0;
                                var suma = 0;
                                var i = idt;
                                var k = idt - 1;

                                var lbmesa = document.getElementById('lbmesa');
                                lbmesa.innerHTML = '';
                                var lbprecio_compra = document.getElementById('lbprecio_compra');
                                lbprecio_compra.innerHTML = '';
                                var lbcantidad = document.getElementById('lbcantidad');
                                lbcantidad.innerHTML = '';
                                var lbpespecial = document.getElementById('lbpespecial');
                                lbpespecial.innerHTML = '';
                                var lbpesprecio = document.getElementById('lbpesprecio');
                                lbpesprecio.innerHTML = '';
                                var lbpespcant = document.getElementById('lbpespcant');
                                lbpespcant.innerHTML = '';
                                var lbcliente = document.getElementById('lbcliente');
                                lbcliente.innerHTML = '';
                                var lbdireccion = document.getElementById('lbdireccion');
                                lbdireccion.innerHTML = '';

                                // Swal.fire({
                                //     title: 'Está seguro que desea abrir la mesa?',
                                //     text: "¡No podrás revertir esto!",
                                //     icon: 'warning',
                                //     showCancelButton: true,
                                //     confirmButtonColor: '#3085d6',
                                //     cancelButtonColor: '#d33',
                                //     cancelButtonText: 'Cancelar',
                                //     confirmButtonText: 'Sí!'
                                // }).then((result) => {
                                //     if (result.isConfirmed) {

                                        if ($('#reducir').val() != 'Si') {
                                            var lbcupon = document.getElementById('lbcupon');
                                            lbcupon.innerHTML = '';
                                            var lbconf_total = document.getElementById(
                                                'lbconf_total');
                                            lbconf_total.innerHTML = '';
                                            var lbdesc = document.getElementById('lbdesc');
                                            lbdesc.innerHTML = '';
                                            var lbres = document.getElementById('lbres');
                                            lbres.innerHTML = '';
                                            var lbpropina = document.getElementById(
                                                'lbpropina');
                                            lbpropina.innerHTML = '';
                                            var lbtotal2 = document.getElementById('lbtotal2');
                                            lbtotal2.innerHTML = '';
                                            var lbdos = document.getElementById('lbdos');
                                            lbdos.innerHTML = '';
                                            var lbtres = document.getElementById('lbtres');
                                            lbtres.innerHTML = '';
                                            var lbmotivoDescuento = document.getElementById(
                                                'lbmotivoDescuento');
                                            lbmotivoDescuento.innerHTML = '';
                                            var lbcomentario = document.getElementById(
                                                'lbcomentario');
                                            lbcomentario.innerHTML = '';
                                        } else {
                                            var lbtotal2 = document.getElementById('lbtotal2');
                                            lbtotal2.innerHTML = '';
                                            var lbcupon = document.getElementById('lbcupon');
                                            lbcupon.innerHTML = '';
                                            var lbdos = document.getElementById('lbdos');
                                            lbdos.innerHTML = '';
                                            var lbtres = document.getElementById('lbtres');
                                            lbtres.innerHTML = '';
                                        }
                                        // $('#cupon').val("");
                                        $('#conftotal').val("");
                                        $('#desc').val("");
                                        $('#res').val("");
                                        $('#propina').val("");
                                        $('#total2').val("");
                                        $('#dos').val("");
                                        $('#tres').val("");
                                        $('#motivoDescuento').val("");

                                        var resultados = document.getElementById('detalle1');
                                        resultados.innerHTML = '';
                                        var detalleTotal = document.getElementById('total');
                                        detalleTotal.innerHTML = '';
                                        $('#total1').val("");
                                        $("#total").html(" ");
                                        $("#total").html("$" + "0.00");
                                        $('#valor').val("0");
                                        $('#incrementa').val("0");
                                        $("#comentario").val("");

                                        $('#id_proveedor').val(tituloMesa);
                                        $('#mesa_estado').val('Abierta');
                                        var mesa = $('#id_proveedor').val();

                                        if (mesa.trim() == 'Para llevar') {
                                            $("#cliente").show();
                                            $("#direccion").show();
                                            $("#clientelb").show();
                                            $("#direccionlb").show();
                                        } else {
                                            $("#direccion").val("");
                                            $("#cliente").val("");
                                            $("#cliente").hide();
                                            $("#direccion").hide();
                                            $("#clientelb").hide();
                                            $("#direccionlb").hide();
                                        }

                                        document.getElementsByTagName("button")[i].innerHTML =
                                            "Atendiendo";
                                        document.getElementsByTagName("button")[i].setAttribute(
                                            "style", "background-color:#C0C0C0;");
                                        document.getElementsByTagName("button")[i].disabled =
                                            true;
                                        document.getElementsByTagName('tr')[i]
                                            .getElementsByTagName('td')[1].setAttribute("style",
                                                "background-color:#ce0018;");
                                        document.getElementsByTagName("button")[i]
                                            .addEventListener("click", cambiar);
                                        document.getElementsByTagName("figure")[k].style
                                            .display = 'block';

                                        function cambiar() {
                                            var estadoMesa = $(this).closest("tr").find(
                                                '.estado_mesa2').val();
                                            var tituloMesa = $(this).closest("tr").find(
                                                '.titulo_mesa').val();
                                            var idt = $(this).closest("tr").find('.id_mesa')
                                                .val();
                                            var sumatotal = 0;
                                            var contador = 0;
                                            var evaluar = 0;
                                            var total = 0;
                                            var dato = 0;
                                            var k = idt - 1;
                                            var f = 0;

                                            var lbmesa = document.getElementById('lbmesa');
                                            lbmesa.innerHTML = '';
                                            var lbprecio_compra = document.getElementById(
                                                'lbprecio_compra');
                                            lbprecio_compra.innerHTML = '';
                                            var lbcantidad = document.getElementById(
                                                'lbcantidad');
                                            lbcantidad.innerHTML = '';
                                            var lbpespecial = document.getElementById(
                                                'lbpespecial');
                                            lbpespecial.innerHTML = '';
                                            var lbpesprecio = document.getElementById(
                                                'lbpesprecio');
                                            lbpesprecio.innerHTML = '';
                                            var lbpespcant = document.getElementById(
                                                'lbpespcant');
                                            lbpespcant.innerHTML = '';
                                            var lbcliente = document.getElementById(
                                                'lbcliente');
                                            lbcliente.innerHTML = '';
                                            var lbdireccion = document.getElementById(
                                                'lbdireccion');
                                            lbdireccion.innerHTML = '';

                                            // Swal.fire({
                                            //     title: 'Está seguro que desea ver la mesa?',
                                            //     text: "¡No podrás revertir esto!",
                                            //     icon: 'warning',
                                            //     showCancelButton: true,
                                            //     confirmButtonColor: '#3085d6',
                                            //     cancelButtonColor: '#d33',
                                            //     cancelButtonText: 'Cancelar',
                                            //     confirmButtonText: 'Sí!'
                                            // }).then((result) => {
                                            //     if (result.isConfirmed) {

                                                    if ($('#reducir').val() != 'Si') {
                                                        var lbcupon = document
                                                            .getElementById('lbcupon');
                                                        lbcupon.innerHTML = '';
                                                        var lbconf_total = document
                                                            .getElementById(
                                                                'lbconf_total');
                                                        lbconf_total.innerHTML = '';
                                                        var lbdesc = document
                                                            .getElementById('lbdesc');
                                                        lbdesc.innerHTML = '';
                                                        var lbres = document
                                                            .getElementById('lbres');
                                                        lbres.innerHTML = '';
                                                        var lbpropina = document
                                                            .getElementById(
                                                                'lbpropina');
                                                        lbpropina.innerHTML = '';
                                                        var lbtotal2 = document
                                                            .getElementById('lbtotal2');
                                                        lbtotal2.innerHTML = '';
                                                        var lbdos = document
                                                            .getElementById('lbdos');
                                                        lbdos.innerHTML = '';
                                                        var lbtres = document
                                                            .getElementById('lbtres');
                                                        lbtres.innerHTML = '';
                                                        var lbmotivoDescuento = document
                                                            .getElementById(
                                                                'lbmotivoDescuento');
                                                        lbmotivoDescuento.innerHTML =
                                                            '';
                                                        var lbcomentario = document
                                                            .getElementById(
                                                                'lbcomentario');
                                                        lbcomentario.innerHTML = '';
                                                    } else {
                                                        var lbtotal2 = document
                                                            .getElementById('lbtotal2');
                                                        lbtotal2.innerHTML = '';
                                                        var lbcupon = document
                                                            .getElementById('lbcupon');
                                                        lbcupon.innerHTML = '';
                                                        var lbdos = document
                                                            .getElementById('lbdos');
                                                        lbdos.innerHTML = '';
                                                        var lbtres = document
                                                            .getElementById('lbtres');
                                                        lbtres.innerHTML = '';
                                                    }

                                                    // $('#cupon').val("");
                                                    $('#conftotal').val("");
                                                    $('#desc').val("");
                                                    $('#res').val("");
                                                    $('#propina').val("");
                                                    $('#total2').val("");
                                                    $('#dos').val("");
                                                    $('#tres').val("");
                                                    $('#motivoDescuento').val("");

                                                    document.getElementsByTagName(
                                                            "figure")[k].style.display =
                                                        'block';
                                                    $('#id_proveedor').val(tituloMesa);
                                                    $('#mesa_estado').val(estadoMesa);
                                                    var mesa = $('#id_proveedor').val();

                                                    if (mesa.trim() == 'Para llevar') {
                                                        $("#cliente").show();
                                                        $("#direccion").show();
                                                        $("#clientelb").show();
                                                        $("#direccionlb").show();
                                                    } else {
                                                        $("#direccion").val("");
                                                        $("#consumo").hide();
                                                        $("#cliente").val("");
                                                        $("#guardar").hide();
                                                        $("#cliente").hide();
                                                        $("#direccion").hide();
                                                        $("#clientelb").hide();
                                                        $("#direccionlb").hide();
                                                    }


                                                    $.ajax({
                                                        url: "/obtenerComanda/" + mesa,
                                                        type: "GET",
                                                        dataType: "json",
                                                        success: function (
                                                            data) {

                                                            data.forEach(
                                                                function (
                                                                    element,
                                                                    indice,
                                                                    array
                                                                ) {

                                                                    var articulo =
                                                                        element
                                                                        .articulo;
                                                                    if (articulo !=
                                                                        null
                                                                    ) {
                                                                        $('#detalles')
                                                                            .append(
                                                                                '<tr class="selected" id="fila' +
                                                                                element
                                                                                .fila +
                                                                                '">' +
                                                                                '<td><button type="button"  class="btn btn-warning" onclick="eliminar(' +
                                                                                element
                                                                                .fila +
                                                                                ',' +
                                                                                element
                                                                                .subtotal +
                                                                                ')">Eliminar</button></td>' +
                                                                                '<td><input type="hidden" name="articulo[]" value="' +
                                                                                element
                                                                                .articulo +
                                                                                '">' +
                                                                                element
                                                                                .articulo +
                                                                                '</td>' +
                                                                                '<td><input type="hidden" name="cantidad[]" value="' +
                                                                                element
                                                                                .cantidad +
                                                                                '">' +
                                                                                element
                                                                                .cantidad +
                                                                                '</td>' +
                                                                                '<td><input type="hidden" name="precio_compra[]" value="' +
                                                                                element
                                                                                .precio_compra +
                                                                                '">' +
                                                                                element
                                                                                .precio_compra +
                                                                                '</td>' +
                                                                                '<td><input type="hidden" name="subtotal[]" value="' +
                                                                                element
                                                                                .subtotal +
                                                                                '">' +
                                                                                element
                                                                                .subtotal +
                                                                                '</td>' +
                                                                                '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                                                                                element
                                                                                .fila +
                                                                                '"></td></tr>'
                                                                            )

                                                                        total
                                                                            +=
                                                                            parseFloat(
                                                                                element
                                                                                .subtotal
                                                                            );
                                                                        base =
                                                                            total
                                                                            .toFixed(
                                                                                2
                                                                            );

                                                                        var cliente =
                                                                            element
                                                                            .cliente;
                                                                        var direccion =
                                                                            element
                                                                            .direccion;
                                                                        $('#cliente')
                                                                            .val(
                                                                                cliente
                                                                            );
                                                                        $('#direccion')
                                                                            .val(
                                                                                direccion
                                                                            );

                                                                    } else {

                                                                        total
                                                                            =
                                                                            0;
                                                                        base =
                                                                            total
                                                                            .toFixed(
                                                                                2
                                                                            );
                                                                    }

                                                                    var comentario =
                                                                        element
                                                                        .comentario;
                                                                    if (comentario !=
                                                                        null
                                                                    ) {
                                                                        $('#comentario')
                                                                            .val(
                                                                                comentario
                                                                            );
                                                                    } else {
                                                                        $("#comentario")
                                                                            .val(
                                                                                ""
                                                                            );
                                                                    }
                                                                });
                                                            evaluar =
                                                                parseInt(
                                                                    total);
                                                            if (evaluar !=
                                                                0) {
                                                                $("#total")
                                                                    .html(
                                                                        "$" +
                                                                        base
                                                                    );
                                                                $('#valor')
                                                                    .val(
                                                                        base
                                                                    );
                                                                $('#total1').val(base);
                                                                $('#total2').val(base);
                                                                $("#guardar")
                                                                    .show();
                                                                $("#consumo")
                                                                    .show();

                                                                var f = data
                                                                    .length -
                                                                    1;
                                                                var dato =
                                                                    data[f]
                                                                    .fila;
                                                                contador =
                                                                    parseInt(
                                                                        dato
                                                                    ) +
                                                                    1;
                                                                $('#incrementa')
                                                                    .val(
                                                                        contador
                                                                    );

                                                                function evaluar() {
                                                                    if (base >
                                                                        0) {
                                                                        $("#guardar")
                                                                            .show();
                                                                        $("#consumo")
                                                                            .show();
                                                                    } else {
                                                                        $("#consumo")
                                                                            .hide();
                                                                        $("#guardar")
                                                                            .hide();
                                                                        $("#total")
                                                                            .html(
                                                                                "$" +
                                                                                "0.00"
                                                                            );
                                                                        $('#total1')
                                                                            .val(
                                                                                ""
                                                                            );
                                                                    }
                                                                }
                                                            } else {
                                                                $('#total1')
                                                                    .val(
                                                                        "");
                                                                $("#total")
                                                                    .html(
                                                                        "$" +
                                                                        "0.00"
                                                                    );
                                                                $('#valor')
                                                                    .val(
                                                                        "0"
                                                                    );
                                                                $('#incrementa')
                                                                    .val(
                                                                        "0"
                                                                    );
                                                                $("#guardar")
                                                                    .hide();
                                                                $("#consumo")
                                                                    .hide();
                                                                if (data ==
                                                                    '') {
                                                                    $("#comentario")
                                                                        .val(
                                                                            ""
                                                                        );
                                                                }
                                                            }

                                                        },
                                                        error: function (
                                                            error) {
                                                            console.log(
                                                                error);
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Error!',
                                                                text: 'No se ha podido obtener la comanda!',
                                                            })
                                                        }
                                                    });

                                                    // Swal.fire(
                                                    //     'consultada!',
                                                    //     'La mesa ha sido consultada.',
                                                    //     'success'
                                                    // )
                                                    var resultados = document
                                                        .getElementById('detalle1');
                                                    resultados.innerHTML = '';
                                                    var detalleTotal = document
                                                        .getElementById('total');
                                                    detalleTotal.innerHTML = '';

                                            //     } else {
                                            //         Swal.fire(
                                            //             'La mesa no ha sido consultada',
                                            //             '', 'info')
                                            //     }
                                            // })
                                        }

                                        var j = document.getElementById("tableUserList").rows
                                            .length;
                                        for (var x = 0; x < j; x++) {
                                            document.getElementsByTagName("button")[x]
                                                .setAttribute("style",
                                                    "background-color:#C0C0C0;");
                                            document.getElementsByTagName("button")[x]
                                                .disabled = true;
                                        }
                                        var elementos = document.getElementsByName(
                                            "titulo_mesa2");
                                        var estados = document.getElementsByName(
                                            "estado_mesa2");
                                        for (y = 0; y < elementos.length; y++) {
                                            if (elementos[y].value == mesa) {
                                                estados[y].value = "Abierta";
                                                document.getElementsByName("estado_mesa2")[y]
                                                    .value = "Abierta";
                                            }
                                        }

                                        var data = {
                                            "_token": $("meta[name='csrf-token']").attr(
                                                "content"),
                                            "idt": idt,
                                            "tituloMesa": tituloMesa
                                        };
                                        $.ajax({
                                            url: "/datosHome",
                                            type: "POST",
                                            data: data,
                                            sucess: function (msg) {
                                                console.log(msg);
                                                location.reload();
                                            },
                                            error: function (error) {
                                                console.log(error);
                                            }

                                        });
                                //     } else {
                                //         Swal.fire('La mesa no se ha abierto', '', 'info')
                                //     }
                                // })
                            }

                            Swal.fire(
                                'Cerrada!',
                                'La mesa ha sido cerrada.',
                                'success'
                            )
                        } else {
                            Swal.fire('La mesa sigue abierta', '', 'info')
                        }

                    })
                });
            }

            $(document).ready(function () {
                setInterval(syncWIthApis3, 950); //Cada 30 segundo (30 mil milisegundos)
            });

        }, 1500);

    </script>

    {{-- Mesa 4 - Ver Mesa --}}
    <script type="text/javascript">
        setTimeout(function(){
            function syncWIthApis4(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var total = 0;
                var suma = 0;

                $('.vermesabtn').click(function (e) {
                    e.preventDefault();
                    localStorage.setItem("tableOrden", '');
                    var estadoMesa = $(this).closest("tr").find('.estado_mesa2').val();
                    var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                    var idt = $(this).closest("tr").find('.id_mesa').val();
                    var contador = 0;
                    var evaluar = 0;
                    var total = 0;
                    var dato = 0;
                    var k = idt - 1;
                    var f = 0;

                    var lbmesa = document.getElementById('lbmesa');
                    lbmesa.innerHTML = '';
                    var lbprecio_compra = document.getElementById('lbprecio_compra');
                    lbprecio_compra.innerHTML = '';
                    var lbcantidad = document.getElementById('lbcantidad');
                    lbcantidad.innerHTML = '';
                    var lbpespecial = document.getElementById('lbpespecial');
                    lbpespecial.innerHTML = '';
                    var lbpesprecio = document.getElementById('lbpesprecio');
                    lbpesprecio.innerHTML = '';
                    var lbpespcant = document.getElementById('lbpespcant');
                    lbpespcant.innerHTML = '';
                    var lbcliente = document.getElementById('lbcliente');
                    lbcliente.innerHTML = '';
                    var lbdireccion = document.getElementById('lbdireccion');
                    lbdireccion.innerHTML = '';

                    // Swal.fire({
                    //     title: 'Está seguro que desea ver la mesa?',
                    //     text: "¡No podrás revertir esto!",
                    //     icon: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#3085d6',
                    //     cancelButtonColor: '#d33',
                    //     cancelButtonText: 'Cancelar',
                    //     confirmButtonText: 'Sí!'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {

                            if ($('#reducir').val() != 'Si') {
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbconf_total = document.getElementById('lbconf_total');
                                lbconf_total.innerHTML = '';
                                var lbdesc = document.getElementById('lbdesc');
                                lbdesc.innerHTML = '';
                                var lbres = document.getElementById('lbres');
                                lbres.innerHTML = '';
                                var lbpropina = document.getElementById('lbpropina');
                                lbpropina.innerHTML = '';
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                                var lbmotivoDescuento = document.getElementById('lbmotivoDescuento');
                                lbmotivoDescuento.innerHTML = '';
                                var lbcomentario = document.getElementById('lbcomentario');
                                lbcomentario.innerHTML = '';
                            } else {
                                var lbtotal2 = document.getElementById('lbtotal2');
                                lbtotal2.innerHTML = '';
                                var lbcupon = document.getElementById('lbcupon');
                                lbcupon.innerHTML = '';
                                var lbdos = document.getElementById('lbdos');
                                lbdos.innerHTML = '';
                                var lbtres = document.getElementById('lbtres');
                                lbtres.innerHTML = '';
                            }

                            // $('#cupon').val("");
                            $('#conftotal').val("");
                            $('#desc').val("");
                            $('#res').val("");
                            $('#propina').val("");
                            $('#total2').val("");
                            $('#dos').val("");
                            $('#tres').val("");
                            $('#motivoDescuento').val("");

                            $('#id_proveedor').val(tituloMesa);
                            $('#mesa_estado').val(estadoMesa);
                            var mesa = $('#id_proveedor').val();
                            document.getElementsByTagName("figure")[k].style.display = 'block';

                            if (mesa.trim() == 'Para llevar') {
                                $("#cliente").show();
                                $("#direccion").show();
                                $("#clientelb").show();
                                $("#direccionlb").show();
                            } else {
                                // $("#consumo").hide();
                                // $("#guardar").hide();
                                $("#cliente").hide();
                                $("#direccion").hide();
                                $("#clientelb").hide();
                                $("#direccionlb").hide();
                            }

                            $.ajax({
                                url: "/obtenerComanda/" + mesa,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {

                                    var tableOrden = localStorage.getItem("tableOrden");

                                    if(tableOrden != ''){
                                        data = JSON.stringify(data);

                                        if(data != tableOrden){
                                            data = JSON.parse(data);
                                            data.forEach(function (element, indice, array) {
                                                var articulo = element.articulo;

                                                if (articulo != null) {
                                                    $('#detalles').append(
                                                        '<tr class="selected" id="fila' +
                                                        element.fila + '">' +
                                                        '<td><button type="button"  class="btn btn-warning" onclick="eliminar(' +
                                                        element.fila + ',' + element
                                                        .subtotal +
                                                        ')">Eliminar</button></td>' +
                                                        '<td><input type="hidden" name="articulo[]" value="' +
                                                        element.articulo + '">' +
                                                        element.articulo + '</td>' +
                                                        '<td><input type="hidden" name="cantidad[]" value="' +
                                                        element.cantidad + '">' +
                                                        element.cantidad + '</td>' +
                                                        '<td><input type="hidden" name="precio_compra[]" value="' +
                                                        element.precio_compra + '">' +
                                                        element.precio_compra +
                                                        '</td>' +
                                                        '<td><input type="hidden" name="subtotal[]" value="' +
                                                        element.subtotal + '">' +
                                                        element.subtotal + '</td>' +
                                                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                                                        element.fila + '"></td></tr>')

                                                    total += parseFloat(element.subtotal);
                                                    base = total.toFixed(2);

                                                    var cliente = element.cliente;
                                                    var direccion = element.direccion;
                                                    $('#cliente').val(cliente);
                                                    $('#direccion').val(direccion);

                                                } else {

                                                    total = 0;
                                                    base = total.toFixed(2);
                                                }

                                                var comentario = element.comentario;
                                                if (comentario != null) {
                                                    $('#comentario').val(comentario);
                                                } else {
                                                    $("#comentario").val("");
                                                }


                                            });
                                            evaluar = parseInt(total);
                                            if (evaluar != 0) {
                                                $("#total").html("$" + base);
                                                $('#valor').val(base);
                                                $('#total1').val(base);
                                                $('#total2').val(base);
                                                $('#res').val(base);
                                                $('#conftotal').val(base);
                                                $("#guardar").show();
                                                $("#consumo").show();
                                                var f = data.length - 1;
                                                var dato = data[f].fila;
                                                contador = parseInt(dato) + 1;
                                                $('#incrementa').val(contador);
                                                // calcular();

                                                function evaluar() {
                                                    if (base > 0) {
                                                        $("#guardar").show();
                                                        $("#consumo").show();
                                                    } else {
                                                        $("#consumo").hide();
                                                        $("#guardar").hide();
                                                        $("#total").html("$" + "0.00");
                                                        $('#total1').val("");
                                                        // calcular();
                                                    }
                                                }
                                            } else {
                                                $('#total1').val("");
                                                $('#conftotal').val("");
                                                $("#total").html("$" + "0.00");
                                                $('#valor').val("0");
                                                $('#incrementa').val("0");
                                                $("#guardar").hide();
                                                $("#consumo").hide();
                                                // calcular();
                                                if (data == '') {
                                                    $("#comentario").val("");
                                                }
                                            }
                                            data = JSON.stringify(data);
                                            localStorage.setItem("tableOrden",data);

                                        }

                                    } else {

                                        data.forEach(function (element, indice, array) {
                                            var articulo = element.articulo;

                                            if (articulo != null) {
                                                $('#detalles').append(
                                                    '<tr class="selected" id="fila' +
                                                    element.fila + '">' +
                                                    '<td><button type="button"  class="btn btn-warning" onclick="eliminar(' +
                                                    element.fila + ',' + element
                                                    .subtotal +
                                                    ')">Eliminar</button></td>' +
                                                    '<td><input type="hidden" name="articulo[]" value="' +
                                                    element.articulo + '">' +
                                                    element.articulo + '</td>' +
                                                    '<td><input type="hidden" name="cantidad[]" value="' +
                                                    element.cantidad + '">' +
                                                    element.cantidad + '</td>' +
                                                    '<td><input type="hidden" name="precio_compra[]" value="' +
                                                    element.precio_compra + '">' +
                                                    element.precio_compra +
                                                    '</td>' +
                                                    '<td><input type="hidden" name="subtotal[]" value="' +
                                                    element.subtotal + '">' +
                                                    element.subtotal + '</td>' +
                                                    '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' +
                                                    element.fila + '"></td></tr>')

                                                total += parseFloat(element.subtotal);
                                                base = total.toFixed(2);

                                                var cliente = element.cliente;
                                                var direccion = element.direccion;
                                                $('#cliente').val(cliente);
                                                $('#direccion').val(direccion);

                                            } else {

                                                total = 0;
                                                base = total.toFixed(2);
                                            }

                                            var comentario = element.comentario;
                                            if (comentario != null) {
                                                $('#comentario').val(comentario);
                                            } else {
                                                $("#comentario").val("");
                                            }


                                        });
                                        evaluar = parseInt(total);
                                        if (evaluar != 0) {
                                            $("#total").html("$" + base);
                                            $('#valor').val(base);
                                            $('#total1').val(base);
                                            $('#total2').val(base);
                                            $('#res').val(base);
                                            $('#conftotal').val(base);
                                            $("#guardar").show();
                                            $("#consumo").show();
                                            var f = data.length - 1;
                                            var dato = data[f].fila;
                                            contador = parseInt(dato) + 1;
                                            $('#incrementa').val(contador);
                                            // calcular();

                                            function evaluar() {
                                                if (base > 0) {
                                                    $("#guardar").show();
                                                    $("#consumo").show();
                                                } else {
                                                    $("#consumo").hide();
                                                    $("#guardar").hide();
                                                    $("#total").html("$" + "0.00");
                                                    $('#total1').val("");
                                                    // calcular();
                                                }
                                            }
                                        } else {
                                            $('#total1').val("");
                                            $('#conftotal').val("");
                                            $("#total").html("$" + "0.00");
                                            $('#valor').val("0");
                                            $('#incrementa').val("0");
                                            $("#guardar").hide();
                                            $("#consumo").hide();
                                            // calcular();
                                            if (data == '') {
                                                $("#comentario").val("");
                                            }
                                        }
                                        data = JSON.stringify(data);
                                        localStorage.setItem("tableOrden",data);
                                    }

                                },
                                error: function (error) {
                                    console.log(error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: '¡Error!',
                                        text: '¡No se ha podido obtener la Comanda!',
                                    })
                                }
                            });

                            // Swal.fire(
                            //     'consultada!',
                            //     'La mesa ha sido consultada.',
                            //     'success'
                            // )
                            var resultados = document.getElementById('detalle1');
                            resultados.innerHTML = '';
                            var detalleTotal = document.getElementById('total');
                            detalleTotal.innerHTML = '';
                    //     } else {
                    //         Swal.fire('La mesa no ha sido consultada', '', 'info')
                    //     }
                    // })
                });
            }

            $(document).ready(function () {
                setInterval(syncWIthApis4, 950); //Cada 30 segundo (30 mil milisegundos)
            });
        }, 1500);

    </script>

    {{-- Eliminar Producto Registrado en Orden --}}
    <script type="text/javascript">
        function evaluar() {
            base = $('#valor').val();
            if (base > 0) {
                $("#guardar").show();
                $("#consumo").show();
            } else {
                $("#consumo").hide();
                $("#guardar").hide();
                $("#total").html("$" + "0.00");
                $('#total1').val("");
            }
        }

        function eliminar(index, subtotal1) {
            Swal.fire({
                title: 'Está seguro que desea eliminar el producto?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                html: '<label for="motivo">Motivo de eliminación</label>' +
                    '<input id="swal-input1" class="swal2-input">',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí!',
                focusConfirm: false,
                preConfirm: () => {
                    const motivo = Swal.getPopup().querySelector('#swal-input1').value
                    if (!motivo) {
                        Swal.showValidationMessage('Ingresa el motivo')
                    }
                    return {
                        motivo: motivo
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    base = $('#valor').val();
                    base = base - subtotal1;
                    $('#valor').val(base);
                    $("#total").html("$" + base);
                    $('#total1').val(base);
                    $('#total2').val(base);
                    $('#conftotal').val(base);
                    $("#fila" + index).remove();
                    evaluar();
                    var motivo = document.getElementById('swal-input1').value;
                    eliminarFila(index, motivo);
                    Swal.fire(
                        'Eliminado!',
                        'El producto ha sido eliminado.',
                        'success'
                    )
                }
            })

        }

        function eliminarFila(index, motivo) {
            var mesa = document.getElementById('id_proveedor').value;
            var estado = document.getElementById('mesa_estado').value;

            var data = {
                "indice": index,
                "mesa": mesa,
                "estado": estado,
                "motivo": motivo,
            };

            $.ajax({
                url: "/eliminarFila",
                type: "POST",
                data: data,
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'No se ha podido eliminar!',
                    })
                }
            });
        }

    </script>

    {{--  --}}

    {{-- Buscador de Productos --}}
    <script>

        // showProducts

        $(function () {
            const input = document.getElementById("product_name");
            input.addEventListener("input", onSelectChange);
            // $('#product_name').on('input', onSelectChange);
        });

        function onSelectChange() {

            var product_name = $(this).val();
            if (product_name.length >= 1) {
                $('#showProducts')
                    .empty()
                ;
            }
            if (product_name.length > 1) {
                $.get('api/producto/' + product_name + '/titulo', function (data) {
                    var html_select = ``;
                    var productSelected = ``;
                    for (var i = 0; i < data.length; ++i){
                        html_select += `
                            <button type="button" id="productResult" class="list-group-item list-group-item-action pe-0 pt-0 pb-0" onclick="onSelectProducto(${data[i].id})">
                                ${data[i].titulo}
                            </button>`;
                    }
                    $('#showProducts').html(html_select);
                });
            }
        }

        function onSelectProducto(id) {

            $('#showProducts')
                .empty()
            ;

            // document.getElementById('product_name').value = "";
            $.get('api/producto/' + id + '/producto', function (data) {
                // console.log(data[0].id);
                var html_select = data[0].precio;
                var id_prod = data[0].id;
                var name_prod = data[0].titulo;

                var producto = '<option option selected="selected" value=" ' + data[0].id + '" >' + data[0].titulo + '</option>';
                $('#producto')
                    .empty()
                    .append(producto)
                ;

                $('#pid_articulo').val(name_prod);
                $('#pprecio_compra').val(html_select);

            });
        }

    </script>

    {{-- Get By Apis --}}
    <script>
        // On window load
        window.onload = function () {
            localStorage.setItem("PaymentMethods", '');
            localStorage.setItem("Tables", '');
            localStorage.setItem("Rooms", '');
            getPayMethods();
            getTables();
            getRooms();
        }


        // On window unload
        window.onbeforeunload = function () {
            localStorage.removeItem("PaymentMethods");
            localStorage.removeItem("tableOrden");
            localStorage.removeItem("Tables");
            localStorage.removeItem("Rooms");
        };

        function getPayMethods() {

            var paymentMethods = localStorage.getItem("PaymentMethods");

            $.get('api/paymentMethods', function (data) {

                if (paymentMethods != '') {
                    data = JSON.stringify(data);

                    if (data != paymentMethods) {

                        data = JSON.parse(data);
                        var html_select = '<option value="" disabled selected>-- Seleccionar --</option>';
                        for (var i = 0; i < data.length; ++i)
                            html_select += '<option value=" ' + data[i].titulo + '" >' + data[i].titulo +
                            '</option>';
                        $('#forma_pago').html(html_select);
                        data = JSON.stringify(data);
                        localStorage.setItem("PaymentMethods", data);
                    }

                } else {
                    var html_select = '<option value="" disabled selected>-- Seleccionar --</option>';
                    for (var i = 0; i < data.length; ++i)
                        html_select += '<option value=" ' + data[i].titulo + '" >' + data[i].titulo + '</option>';
                    $('#forma_pago').html(html_select);
                    data = JSON.stringify(data);
                    localStorage.setItem("PaymentMethods", data);
                }

            });
        }
        $(document).ready(function () {
            setInterval(getPayMethods, 20000); //Cada 30 segundo (30 mil milisegundos)
        });

        function getRooms() {

            var rooms = localStorage.getItem("Rooms");

            $.get('api/rooms', function (data) {

                if (rooms != '') {
                    data = JSON.stringify(data);

                    if (data != rooms) {

                        data = JSON.parse(data);
                        var html_select = '<option value="" disabled selected>-- Seleccionar --</option>';
                        for (var i = 0; i < data.length; ++i)
                            html_select += '<option value=" ' + data[i].room_number + '" >' + data[i].room_number +
                            '</option>';
                        $('#habitacion').html(html_select);
                        data = JSON.stringify(data);
                        localStorage.setItem("Rooms", data);
                    }

                } else {
                    var html_select = '<option value="" disabled selected>-- Seleccionar --</option>';
                    for (var i = 0; i < data.length; ++i)
                        html_select += '<option value=" ' + data[i].room_number + '" >' + data[i].room_number +
                        '</option>';
                    $('#habitacion').html(html_select);
                    data = JSON.stringify(data);
                    localStorage.setItem("Rooms", data);
                }

            });
        }
        $(document).ready(function () {
            setInterval(getRooms, 20000); //Cada 30 segundo (30 mil milisegundos)
        });

        function getTables(){

            var tables = localStorage.getItem("Tables");

            $.get('api/tables', function (data) {

                if(tables != ''){
                    data = JSON.stringify(data);

                    if(data != tables){

                        data = JSON.parse(data);
                        var html_select = '';
                        for (var i = 0; i < data.length; ++i) {
                            var viewOfButton = ''
                            if(data[i].estado != 'Abierta'){
                                viewOfButton += `
                                    <button type="button" id="mesa" name="mesa" class="btn btn-info mesabtn"
                                        target="_blank">
                                        Abrir mesa
                                    </button>
                                    <figure id="elem" name="elem" style="display:none; cursor: pointer;" class="mt-2 mb-0">
                                        <a id="cerrar" name="cerrar" class="cerrar">
                                            <img src="/img/papelera.png" height="25" width="25">
                                            Cerrar
                                        </a>
                                    </figure>
                                `;
                            } else{
                                viewOfButton += `
                                    <button type="button" id="mesa" name="mesa" class="btn btn-info vermesabtn"
                                        target="_blank">
                                        Ver mesa
                                    </button>
                                    <figure id="elem" name="elem" class="mt-2 mb-0" style="cursor: pointer;">
                                        <a id="cerrar" name="cerrar" class="cerrar">
                                            <img src="/img/papelera.png" height="25" width="25">
                                            Cerrar
                                        </a>
                                    </figure>
                                `;
                            }
                            html_select +=`
                                <tr>
                                    <input type="hidden" class="id_mesa" value="${data[i].id}">
                                    <input type="hidden" class="titulo_mesa" value="${data[i].titulo}">
                                    <input type="hidden" id="estado_mesa" name="estado_mesa" class="estado_mesa"
                                        value="${data[i].estado}">
                                    <td class="filaMesa" style="vertical-align:middle;">${data[i].titulo}</td>
                                    <td bgcolor="${data[i].color}"></td>
                                    <td class="text-center">
                                        ${viewOfButton}
                                    </td>
                                    <td style="visibility:hidden;"><input type="hidden" id="estado_mesa2" name="estado_mesa2"
                                            class="estado_mesa2" value="${data[i].estado}"></td>
                                    <td style="visibility:hidden;"><input type="hidden" id="titulo_mesa2" name="titulo_mesa2"
                                            class="titulo_mesa2" value="${data[i].titulo}"></td>
                                </tr>
                            `;
                        }

                        $('#mesaStatus').html(html_select);
                        data = JSON.stringify(data);
                        localStorage.setItem("Tables",data);
                    }

                } else {
                    var html_select = '';
                    for (var i = 0; i < data.length; ++i) {
                        var viewOfButton = ''
                        if(data[i].estado != 'Abierta'){
                            viewOfButton += `
                                <button type="button" id="mesa" name="mesa" class="btn btn-info mesabtn" target="_blank">
                                    Abrir mesa
                                </button>
                                <figure id="elem" name="elem" style="display:none; cursor: pointer;" class="mt-2 mb-0">
                                    <a id="cerrar" name="cerrar" class="cerrar">
                                        <img src="/img/papelera.png" height="25" width="25">
                                        Cerrar
                                    </a>
                                </figure>
                            `;
                        } else{
                            viewOfButton += `
                                <button type="button" id="mesa" name="mesa" class="btn btn-info vermesabtn" target="_blank">
                                    Ver mesa
                                </button>
                                <figure id="elem" name="elem" class="mt-2 mb-0" style="cursor: pointer;">
                                    <a id="cerrar" name="cerrar" class="cerrar">
                                        <img src="/img/papelera.png" height="25" width="25">
                                        Cerrar
                                    </a>
                                </figure>
                            `;
                        }
                        html_select +=`
                            <tr>
                                <input type="hidden" class="id_mesa" value="${data[i].id}">
                                <input type="hidden" class="titulo_mesa" value="${data[i].titulo}">
                                <input type="hidden" id="estado_mesa" name="estado_mesa" class="estado_mesa"
                                    value="${data[i].estado}">
                                <td class="filaMesa" style="vertical-align:middle;">${data[i].titulo}</td>
                                <td bgcolor="${data[i].color}"></td>
                                <td class="text-center">
                                    ${viewOfButton}
                                </td>
                                <td style="visibility:hidden;"><input type="hidden" id="estado_mesa2" name="estado_mesa2"
                                        class="estado_mesa2" value="${data[i].estado}"></td>
                                <td style="visibility:hidden;"><input type="hidden" id="titulo_mesa2" name="titulo_mesa2"
                                        class="titulo_mesa2" value="${data[i].titulo}"></td>
                            </tr>
                        `;
                    }

                    $('#mesaStatus').html(html_select);
                    data = JSON.stringify(data);
                    localStorage.setItem("Tables",data);
                }

            });
        }
        $( document ).ready(function() {
            setInterval(getTables, 10000);//Cada 10 segundo (30 mil milisegundos)
        });

    </script>

@endsection
