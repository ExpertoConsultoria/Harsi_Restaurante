@extends('layouts.app')

@section('content')

    @if(Auth::check())

        <div class="container-fluid">
            <div class="px-0 mx-0 mt-2 row">

                <!-- Tabla de Mesas -->
                <div class="col-sm-3">
                    <div class="row">
                        <table id="tableUserList" class="table">
                            <thead class="text-center table-primary">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th style="width:1%">Estado</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>

                            <tbody id="mesaStatus"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Formulario de Comandas -->
                <div class="col-sm-9">
                    <form method="POST" action="/inicio" id="sample_venta" name="sample_venta" class="form-horizontal" enctype="multipart/form-data">

                        <!-- Detalles Generales -->
                        <div class="card border-dark">
                            <div class="pb-0 card-body">
                                <div class="row">

                                    {{-- First Row --}}
                                        {{-- Fecha --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" id="fecha" name="fecha" class="form-control"
                                                    value="<?php echo date("Y-m-d");?>" required readonly="readonly"
                                                    style="background-color:#FFF;cursor: no-drop;">
                                            </div>
                                        </div>

                                        {{-- Mesa Atendida --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="mesa">Mesa</label>
                                                <input type="text" name="mesa" id="id_proveedor" class="form-control"
                                                    readonly="readonly" style="background-color:#FFF;cursor: no-drop;" required>
                                                <label class="mb-0" for="" id="lbmesa"></label>
                                            </div>
                                        </div>

                                        {{-- Usuario --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="cajero">Cajero</label>
                                                <input readonly="readonly" style="background-color:#FFF;cursor: no-drop;"
                                                    id="cajero" type="text" class="form-control" name="cajero"
                                                    value="{{Auth::user()->name}}" required>
                                            </div>
                                        </div>

                                        {{-- Forma de Pago --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="cajero">Forma de pago</label>
                                                <select class="form-control" name="forma_pago" id="forma_pago"
                                                    title="Seleccione la forma de pago.">
                                                    <option value="" disabled selected>Seleccionar</option>
                                                </select>
                                                <label class="mb-0" for="" id="lbpago"></label>
                                            </div>
                                        </div>

                                    {{-- Seconds Row --}}

                                        {{-- Guia --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="guide">Guia</label>
                                                <select class="form-control" name="guide" id="guide"
                                                    title="Seleccione el Guía.">

                                                    @foreach ($guias as $guia)

                                                        @if ($guia->id === 1)
                                                            <option value="{{ $guia->id }}" selected>{{ $guia->full_name }}</option>
                                                        @else
                                                            <option value="{{ $guia->id }}">{{ $guia->full_name }}</option>
                                                        @endif

                                                    @endforeach

                                                </select>
                                                <label class="mb-0" for="" id="lbguide"></label>
                                            </div>
                                        </div>

                                        {{-- Comisión --}}
                                        <div class="col-md-3" id="comision_col">
                                            <div class="my-0 form-group">
                                                <label for="comision">Comisión</label>
                                                <input id="comision" class="form-control" name="comision" onchange="redondearDecimales('comision')"
                                                    placeholder="Comisión %" value="" step="0.1"
                                                    autocomplete="off" type="number">
                                                <label for="" id="lbcomision"></label>
                                            </div>
                                        </div>

                                        {{-- Mesero --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="mesero">Mesero</label>
                                                <select class="form-control" name="mesero" id="mesero"
                                                    title="Seleccione el Mesero." required>
                                                    <option value="" disabled selected>-- Seleccione --</option>

                                                    @foreach ($meseros as $mesero)
                                                        <option value="{{ $mesero->id }}">{{ $mesero->full_name }}</option>
                                                    @endforeach

                                                </select>
                                                <label class="mb-0" for="" id="lbmesero"></label>
                                            </div>
                                        </div>

                                        {{-- Comensales --}}
                                        <div class="col-md-3">
                                            <div class="my-0 form-group">
                                                <label for="comensales">Comensales</label>
                                                <input
                                                    type="number"
                                                    id="comensales"
                                                    name="comensales"
                                                    class="form-control"
                                                    value="1"
                                                    placeholder="Cantidad de Comensales"
                                                    onkeydown="return false"
                                                    step="1"
                                                    max="10"
                                                    min="1"
                                                >
                                            </div>
                                        </div>

                                    {{-- Third Row --}}
                                        {{-- Turno de Atención --}}
                                        <div style="display:none" class="col-md-6">
                                            <div class="my-0 form-group">
                                                <label name="turnolb" id="turno" for="turnolb">Turno</label>
                                                <input type="text" name="turno" id="turno" value="{{Auth::user()->turno}}"
                                                    class="form-control">
                                                <label for="" id="lbturno"></label>
                                            </div>
                                        </div>

                                        {{-- Cliente --}}
                                        <div class="col-md-6" id="cliente_input">
                                            <div class="my-0 form-group">
                                                <label name="clientelb" id="clientelb" for="clientelb">Cliente</label>
                                                <input type="text" name="cliente" id="cliente" class="form-control">
                                                <label for="" id="lbcliente"></label>
                                            </div>
                                        </div>

                                        {{-- Dirección del Cliente --}}
                                        <div class="col-md-6">
                                            <div class="my-0 form-group" id="direccion_input">
                                                <label name="direccionlb" id="direccionlb" for="direccionlb">Dirección</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control">
                                                <label for="" id="lbdireccion"></label>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <!-- Comanda Productos -->
                        <div class="row justify-content-center align-items-center g-2">

                            {{-- Select Products --}}
                            <div class="col-9">

                                {{-- CSRF Token --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                {{-- Search Product --}}
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center g-2">

                                            {{-- Serach by Name --}}
                                            <div class="col-12">
                                                {{-- Search bar --}}
                                                <div class="mb-1 form-group" id="searchProducto">
                                                    <input id="product_name" value="" class="form-control" type="text" placeholder="Buscar Producto" data-live-search="true">
                                                </div>
                                                {{-- List of Results --}}
                                                <div class="mb-3 list-group" id="showProducts" tabindex="1">
                                                    <div id="showProducts"></div>
                                                </div>
                                            </div>

                                            {{-- Filter by Categories --}}
                                            @if($restaurante['subcategoria'] != 'No')

                                                {{-- is Subcategories enable? --}}
                                                <input type="hidden" id="rsubcategoria" class="form-control" value="{{ $restaurante['subcategoria'] }}">

                                                <div class="col-6">
                                                    <div class="row justify-content-center align-items-center g-2">

                                                        {{-- Categoria --}}
                                                        <div class="col-11">
                                                            <div class="form-group">
                                                                <label class="mb-0" for="select_categoria">Categoría</label>
                                                                <select id="select_categoria" name="select_categoria" size="4" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled>-- Selecciona --</option>
                                                                    @foreach($product_categories as $cta)
                                                                        <option value="{{ $cta->id }}">{{ $cta->titulo }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        {{-- Subcategoria --}}
                                                        <div class="col-11">
                                                            <div class="form-group">
                                                                <label class="mb-0" for="select_subcategoria">Subcategoría</label>
                                                                <select id="select_subcategoria" name="select_subcategoria" size="4" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled>-- Selecciona --</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @else
                                                <div class="pb-5 col-6">
                                                    <div class="row justify-content-center align-items-center g-2">

                                                        {{-- is Subcategories enable? --}}
                                                        <input type="hidden" id="rsubcategoria" class="form-control" value="{{ $restaurante['subcategoria'] }}">

                                                        {{-- Categoria --}}
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="select_categoria">Categoría</label>
                                                                <select id="select_categoria" name="select_categoria" size="6" class="form-control selectpicker" data-live-search="true">
                                                                    <option selected disabled>-- Selecciona una Categoría --</option>
                                                                    @foreach($product_categories as $cta)
                                                                        <option value="{{ $cta->id }}">{{ $cta->titulo }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Product Data --}}
                                            <div class="col-6">
                                                <div class="row justify-content-center align-items-center g-2">

                                                    {{-- Nombre --}}
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="producto" class="mb-0">Producto</label>
                                                            <select id="producto" class="form-control selectpicker" data-live-search="true">
                                                                <option value="">-- -- --</option>
                                                            </select>
                                                            <input id="pid_articulo" class="form-control user" type="text">
                                                        </div>
                                                    </div>

                                                    {{-- Precio --}}
                                                    <div class="mt-0 col-12">
                                                        <div class="form-group">
                                                            <label for="pprecio_compra" class="mb-0">Precio</label>
                                                            <input id="pprecio_compra" class="form-control" type="text" readonly="readonly" style="background-color:#FFF;cursor: no-drop;">
                                                            <label for="" id="lbprecio_compra"></label>
                                                        </div>
                                                    </div>

                                                    {{-- Cantidad Adquirida --}}
                                                    <div class="col-12" style="margin-top: -1.5rem">
                                                        <label for="pcantidad" class="mb-0">Cantidad</label>
                                                        <input type="number" min="1" max="9" id="pcantidad" class="form-control" value="1">
                                                        <label for="" id="lbcantidad"></label>
                                                    </div>

                                                    {{-- Submit --}}
                                                    <div class="col-12">
                                                        <div class="text-center form-group">
                                                            <button type="button" id="bt_add" class="text-center btn btn-warning">Registrar</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Use Extra Product --}}
                            <div class="col-3">

                                {{-- CSRF Token --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                {{-- Descrive Product --}}
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
                                                <div class="text-center form-group">
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

                        <!-- Cobro del Servicio -->
                        <div class="row">
                            <div class="col-sm-12">

                                {{-- CSRF Token --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                                {{-- Comentarios y Finanzas --}}
                                <div class="card border-success" style="margin-top:10px">
                                    <div class="card-body">
                                        <div class="row">

                                            {{-- Sección comentarios --}}
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

                                            {{-- Secret Values --}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="hidden" id="userDescuento" name="userDescuento"
                                                            value="{{$descuento}}" class="form-control">
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

                                            {{-- Resumen del Servicio --}}
                                                <div class="table-responsive" style="overflow:hidden;">
                                                    <table id="detalles" name="detalles" class="table table-bordered table-striped">

                                                        {{-- Headers --}}
                                                        <thead class="table-success">
                                                            <th>Acciones</th>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio Compra</th>
                                                            <th>Subtotal</th>
                                                        </thead>

                                                        {{-- Footer - Cobro --}}
                                                        <tfoot>
                                                            <th id="totalEtiqueta">Subtotal</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>

                                                                {{-- Total (Text) --}}
                                                                <h1 id="total" style="margin-bottom: -1rem;">0.00</h1>

                                                                {{-- Total for Products --}}
                                                                <input type="hidden" id="total1" class="m-0" name="total1">

                                                                {{-- Total Original sin Modificaciones --}}
                                                                <input id="conftotal" name="conf_total" type="hidden" autocomplete="off" required>
                                                                <label for="" id="lbconf_total"></label>

                                                                {{-- Desceunto Asignado --}}
                                                                <input id="desc" class="form-control" name="descuento" onchange="calcular()"
                                                                    placeholder="Descuento %" style="margin-top:5px;" value=""
                                                                    autocomplete="off" type="number">
                                                                <label for="" id="lbdesc"></label>

                                                                {{-- Motivo de Descuento --}}
                                                                <input id="motivoDescuento" class="form-control"
                                                                    name="motivoDescuento" placeholder="Motivo del descuento"
                                                                    style="">
                                                                <label for="" id="lbmotivoDescuento"></label>

                                                                {{-- Cantidad Descontada --}}
                                                                <input type="hidden" id="descuento1" class="form-control"
                                                                    name="descuento1">

                                                                {{-- Total Calculado (Sin Propina) --}}
                                                                <input id="res" class="form-control " name="total" autocomplete="off"
                                                                    placeholder="Subtotal" required style="margin-top:5px; font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbres"></label>

                                                                {{-- Cobro por Comisión --}}
                                                                <input id="comision_price" class="form-control" name="comision_price" placeholder="Cobro por Comisión"
                                                                    style="margin-top:5px; font-weight: bold;" autocomplete="off" required type="number" step=".01"
                                                                    readonly="readonly" style="background-color:#FFF;cursor: no-drop;"
                                                                    onchange="redondearDecimales('comision_price')">
                                                                <label for="" id="lbcomision_price"></label>

                                                                {{-- Propina --}}
                                                                <input id="propina" class="form-control " name="propina"
                                                                placeholder="Propina $" style="margin-top:5px;" value=""
                                                                autocomplete="off" required type="number" onchange="redondearDecimales('propina')">
                                                                <label for="" id="lbpropina"></label>

                                                                {{-- Total Calculado (Con Propina y Comisión) --}}
                                                                <input id="total2" class="form-control" name="total2"
                                                                    autocomplete="off" placeholder="Total" required
                                                                    style="margin-top:5px;font-weight: bold;" required
                                                                    readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtotal2"></label>

                                                                {{-- Cantidad Pagada --}}
                                                                <input id="dos" class="form-control" name="pago" placeholder="Pago"
                                                                    style="margin-top:5px;" autocomplete="off" required type="number" step=".01"
                                                                    onchange="redondearDecimales('dos')">
                                                                <label for="" id="lbdos"></label>

                                                                {{-- Cambio Regresado --}}
                                                                <input id="tres" class="form-control" name="cambio"
                                                                    placeholder="Cambio" style="margin-top:5px;" autocomplete="off"
                                                                    required readonly="readonly"
                                                                    style="background-color:#FFF;cursor: no-drop;">
                                                                <label for="" id="lbtres"></label>

                                                            </th>
                                                        </tfoot>

                                                        {{-- Resumen de Productos Adquiridos --}}
                                                        <tbody id="detalle1"></tbody>

                                                    </table>

                                                    {{-- Guardar Orden --}}
                                                    <div class="row">
                                                        <div class="col-md-9"></div>

                                                        <div class="col-md-3" id="guardar">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary pagar" id="pComanda" type="button">
                                                                    Pagar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    @else
        @include('error')
    @endif

@endsection

@section('funciones')
    {{-- Importaciones --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- Funciones Generales --}}
    <script type="text/javascript">

        // Reiniciar Tabla de Mesas
        function reiniciar() {
            var k = $("#tableUserList tr").length; // Obtener la cantidad de filas
            var elementos = $("input[name='estado_mesa2']"); // Seleccionar los elementos por nombre

            elementos.each(function(index) {
                var estado = $(this).val(); // Obtener el valor del elemento
                var button = $("button").eq(index + 1); // Seleccionar el botón correspondiente

                if (estado === "Abierta") {
                    button.css("background-color", "#6cb2eb")
                        .prop("disabled", false)
                        .text("Ver mesa");
                } else if (estado === "Cerrada") {
                    button.css("background-color", "#6cb2eb")
                        .prop("disabled", false)
                        .text("Abrir mesa");
                }
            });
        }

        // Redondear Decimal
        function redondearDecimales(inputId) {
            var numero = parseFloat($('#' + inputId).val()) || 0;

            if (numero < 0)
                numero = Math.abs(numero);

            var result = numero.toFixed(2);
            $('#' + inputId).val(result);

            return;
        }

    </script>

    {{-- Guardar Comentarios --}}
    <script type="text/javascript">

        $(document).ready(function () {
            $("#guardarComentario").click(function () {
                guardarComentario();
            });
        });

        function guardarComentario() {
            var fecha = $('#fecha').val();
            var mesa = $('#id_proveedor').val();
            var estado = $('#mesa_estado').val();
            var cajero = $('#cajero').val();

            var guide = $('#guide').val();
            var comision = $('#comision').val();
            var mesero = $('#mesero').val();
            var comensales = $('#comensales').val();

            var cliente = $('#cliente').val();
            var direccion = $('#direccion').val();

            var comentario = $('#comentario').val();

            if (comentario !== "" && mesa !== "") {
                var data = {
                    "fecha": fecha,
                    "mesa": mesa,
                    "estado": estado,
                    "cajero": cajero,
                    "guide": guide,
                    "comision": comision,
                    "mesero": mesero,
                    "comensales": comensales,
                    "cliente": cliente,
                    "direccion": direccion,
                    "comentario": comentario
                };

                $.ajax({
                    url: "/guardarComentario", // Guardamos Comebtario de Orden
                    type: "POST",
                    data: data,
                    success: function (response) {
                        reiniciar();
                        $('#lbcomentario').html('');

                        Swal.fire(
                            'Guardado!',
                            'El comentario ha sido guardado exitosamente.',
                            'success'
                        );
                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'No se ha podido guardar 1!',
                        });
                    }
                });
            } else {
                if (mesa.trim() === '') {
                    $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                    $('#id_proveedor').focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error: el campo mesa es obligatorio, seleccione la mesa!',
                    });
                    return false;
                } else if (comentario === '') {
                    $('#lbcomentario').html("<span style='color:red;'>Ingrese el comentario</span>");
                    $('#comentario').focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error: el campo comentario es obligatorio, ingrese el comentario!',
                    });
                    return false;
                }
            }
        }

    </script>

    {{-- Abrir Mesa --}}
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#open_table', function (e) {
                e.preventDefault();

                localStorage.setItem("tableOrden", '');

                var $tr = $(this).closest("tr");
                var tituloMesa = $tr.find('.titulo_mesa').val();
                var idt = $tr.find('.id_mesa').val();
                var i = idt;
                var k = idt - 1;

                // Limpiamos las Etiquetas Superiores
                $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbmesero, #lbguide, #lbcomision, #lbdireccion').html('');

                // Limpiar Valores del Resumen
                $('#detalle1').html('');    // Tabla de Productos
                $('#total').html('');       // Total Visual

                // Limpiamos las Etiquetas del Formulario de Pago
                $('#lbconf_total, #lbcupon, #lbdesc, #lbres, #lbcomision_price, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbcomision_price, #lbmotivoDescuento, #lbcomentario').html('');

                // Reseteamos Valores del Formulario de Pago
                $('#product_name, #total1, #comentario, #conftotal, #desc,  #res, #comision_price, #propina, #total2, #dos, #tres, #motivoDescuento, #Comisión').val("");

                $("#total").html("");
                $("#total").html("$" + "0.00");

                $('#valor, #incrementa').val("0");

                // Don Agave Inputs
                $('#guide').val(1).trigger('change');
                $('#mesero').val("");
                $('#comensales').val(1);

                // Colocamos los Valores de la Mesa en la Pantalla
                $('#id_proveedor').val(tituloMesa);
                $('#mesa_estado').val('Abierta');

                var mesa = $('#id_proveedor').val();

                if (mesa.trim() == 'Para llevar') {
                    $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").show();
                } else {
                    $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").hide();
                    $("#cliente, #direccion").val("");
                }

                // Cambiamos el Boton Principal de la Mesa
                $('button').eq(i).html("Atendiendo")
                    .css("background-color", "#C0C0C0")
                    .prop("disabled", true);
                $('tr').eq(i).find('td').eq(1).css("background-color", "#ce0018");
                $('button').eq(i).on("click", cambiar);
                $('figure').eq(k).css("display", 'block');

                function cambiar() {
                    var $tr = $(this).closest("tr");
                    var tituloMesa = $tr.find('.titulo_mesa').val();
                    var estadoMesa = $tr.find('.estado_mesa2').val();
                    var idt = $tr.find('.id_mesa').val();

                    var contador = 0;
                    var evaluar = 0;
                    var total = 0;
                    var suma = 0;
                    var base = 0;
                    var dato = 0;
                    var k = idt - 1;
                    var f = 0;

                    // Reseteamos Etiquetas Superiores
                    $('#lbmesa, #lbcomision, #lbguide, #lbmesero, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion').html('');

                    // Reseteamos Etiquetas del Formulario de Pag0
                    $('#lbconf_total, #lbcupon, #lbdesc, #lbres, #lbcomision_price, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

                    // Reseteamos Formulario de Pag0
                    $('#conftotal, #desc, #res, #comision_price, #propina, #total2, #dos, #tres, #motivoDescuento').val("");

                    $('#id_proveedor').val(tituloMesa);
                    $('#mesa_estado').val(estadoMesa);

                    var mesa = $('#id_proveedor').val();
                    $('figure').eq(k).css('display', 'block');

                    if (mesa.trim() == 'Para llevar') {
                        $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").show();
                    } else {
                        $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").hide();
                        $("#cliente, #direccion").val("");
                    }

                    $.ajax({
                        url: "/obtenerComanda/" + mesa, // Obtenemos Comanda Temporal
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            let total = 0;
                            let base = "0.00";

                            data.forEach(function (element) {
                                const articulo = element.articulo;

                                if (articulo != null) {
                                    // Añadir fila a la tabla
                                    $('#detalles').append(createRow(element));

                                    // Calcular total
                                    total += parseFloat(element.subtotal);
                                    base = total.toFixed(2);

                                    // Actualizar cliente y dirección
                                    $('#cliente').val(element.cliente);
                                    $('#direccion').val(element.direccion);
                                } else {
                                    total = 0;
                                    base = total.toFixed(2);
                                }

                                // Actualizar comentario
                                $('#comentario').val(element.comentario != null ? element.comentario : "");
                            });

                            updateTotal(base, total, data.length);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido obtener la comanda!',
                            });
                        }
                    });

                    // Función para crear la fila de la tabla
                    function createRow(element) {
                        return `<tr class="selected" id="fila${element.fila}">
                            <td>
                                <button type="button" class="btn btn-warning" onclick="eliminar(${element.fila}, ${element.subtotal})">Eliminar</button>
                            </td>
                            <td>
                                <input type="hidden" name="articulo[]" value="${element.articulo}">${element.articulo}
                            </td>
                            <td>
                                <input type="hidden" name="cantidad[]" value="${element.cantidad}">${element.cantidad}
                            </td>
                            <td>
                                <input type="hidden" name="precio_compra[]" value="${element.precio_compra}">${element.precio_compra}
                            </td>
                            <td>
                                <input type="hidden" name="subtotal[]" value="${element.subtotal}">${element.subtotal}
                            </td>
                            <td style="visibility:hidden;">
                                <input type="hidden" id="indice" name="indice" class="indice" value="${element.fila}">
                            </td>
                        </tr>`;
                    }

                    // Función para actualizar el total y mostrar/ocultar elementos
                    function updateTotal(base, total, dataLength) {
                        const evaluar = parseInt(total);

                        if (evaluar !== 0) {
                            $("#total").html("$" + base);
                            $('#valor, #total1, #total2').val(base);
                            $("#guardar").show();

                            const contador = parseInt(dataLength > 0 ? data[dataLength - 1].fila : 0) + 1;
                            $('#incrementa').val(contador);
                        } else {
                            resetFields();
                        }
                    }

                    // Función para reiniciar campos
                    function resetFields() {
                        $('#total1').val("");
                        $("#total").html("$0.00");
                        $('#valor, #incrementa').val("0");
                        $("#guardar").hide();
                    }

                    $('#detalle1, #total').html('');

                }

                var j = $('#tableUserList tr').length;
                for (var x = 0; x < j; x++) {
                    $('button').eq(x).css("background-color", "#C0C0C0").prop("disabled", true);
                }

                var elementos = $("input[name='titulo_mesa2']");
                var estados = $("input[name='estado_mesa2']");
                for (var y = 0; y < elementos.length; y++) {
                    if (elementos.eq(y).val() == mesa) {
                        estados.eq(y).val("Abierta");
                    }
                }

                var data = {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "idt": idt,
                    "tituloMesa": tituloMesa
                };

                $.ajax({
                    url: "/datosHome", // Abrimos Mesa
                    type: "POST",
                    data: data,
                    success: function (msg) {},
                    error: function (error) {}
                });

            });

        });
    </script>

    {{-- Cerrar Mesa --}}
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#close_table', function (e) {
                e.preventDefault();

                var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                var idt = $(this).closest("tr").find('.id_mesa').val();
                var k = idt - 1;

                // Detalles Genereales de la Orden
                var fecha = $('#fecha').val();
                var mesa = $('#id_proveedor').val();
                var estado = $('#mesa_estado').val();
                var cajero = $('#cajero').val();

                var mesero = $('#mesero').val();
                var comision = $('#comision').val();
                var guide = $('#guide').val();
                var comensales = $('#comensales').val();

                var cliente = $('#cliente').val();
                var direccion = $('#direccion').val();
                var comentario = $('#comentario').val();

                // Limpiamos las Etiquetas Superiores
                $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion, #lbmesero, #lbguide, #lbcomision').html('');

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

                        // Limpiamos las Etiquetas del Formulario de Pago
                        $('#lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario, #lbcomision_price').html('');

                        // Reseteamos Valores del Formulario de Pago
                        $('#conftotal, #desc, #res, #comision_price, #propina, #total2, #dos, #tres, #motivoDescuento').val("");

                        var estadoMesa = $(this).closest("tr").find('.estado_mesa2').val();
                        var motivo = $('#swal-input1').val();
                        $('#motivo').val(motivo);

                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "idt": idt,
                            "tituloMesa": tituloMesa,
                            "motivo": motivo,
                            "estadoMesa": estadoMesa
                        };

                        $.ajax({
                            url: "/cerrarMesa", // Cerrar mesa
                            type: "POST",
                            data: data,
                            success: function (msg) {},
                            error: function (error) {
                                console.log(error);
                            }
                        });

                        if ($('#id_proveedor').val() == tituloMesa) {
                            $.ajax({
                                url: "/ordenCancelada", // Guardar Orden Cancelada
                                type: "POST",
                                data: $('#sample_venta').serialize(),
                                success: function (data) {},
                                error: function (error) {
                                    console.log(error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'No se ha podido guardar X!',
                                    });
                                }
                            });
                        }

                        var mesa = $('#id_proveedor').val();
                        $('figure').eq(k).hide();

                        $('tr').eq(idt).find('td').eq(1).css("background-color", "#008000");
                        $('button').eq(idt).css("background-color", "#FFFFFF").prop("disabled", false).text("Abrir mesa").off('click').on('click', cambiar);

                        var j = $('#tableUserList tr').length;
                        for (var x = 0; x < j; x++) {
                            $('button').eq(x).css("background-color", "#FFFFFF").prop("disabled", false);
                        }

                        var elementos = $("input[name='titulo_mesa2']");
                        var estados = $("input[name='estado_mesa2']");
                        for (var y = 0; y < elementos.length; y++) {
                            if ($(elementos[y]).val() == tituloMesa) {
                                $(estados[y]).val("Cerrada");
                            } else if ($(elementos[k]).val() == tituloMesa) {
                                $(estados[k]).val("Cerrada");
                                // $('label').eq(k).hide(); // Descomentar si es necesario
                            }
                        }

                        if (tituloMesa == mesa) {
                            $('#detalle1, #total').html('');

                            $('#lbconf_total, #lbcupon, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario, #lbcomision_price').html('');

                            $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #total1, #id_proveedor, #direccion, #cliente, #comentario, #comision_price').val('');

                            $('#Comisión, #mesero').val("");
                            $('#guide').val(1).trigger('change');
                            $('#comensales').val(1);

                            $('#total').html("$0.00");
                            $('#incrementa, #valor').val('0');

                            $('#guardar, #cliente_input, #cliente, #direccion_input, #direccion, #clientelb, #direccionlb, #comision_col, #comision_price, #res').hide();
                        }

                        function cambiar() {
                            var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                            var idt = $(this).closest("tr").find('.id_mesa').val();
                            var total = 0;
                            var suma = 0;
                            var i = idt;
                            var k = idt - 1;

                            $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion').html('');

                            $('#lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario, #lbcomision_price').html('');

                            $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #total1, #comentario, #comision_price').val('');
                            $('#detalle1, #total').html('');

                            $('#guide').val(1);
                            $('#Comisión, #mesero').val("");
                            $('#comensales').val(1);

                            $("#total").html("$" + "0.00");
                            $('#valor').val("0");
                            $('#incrementa').val("0");

                            $('#id_proveedor').val(tituloMesa);
                            $('#mesa_estado').val('Abierta');
                            var mesa = $('#id_proveedor').val();

                            if (mesa.trim() === 'Para llevar') {
                                $("#cliente, #direccion, #clientelb, #direccionlb, #cliente_input, #direccion_input").show();
                            } else {
                                $("#direccion, #cliente").val("").hide();
                                $("#clientelb, #direccionlb, #cliente_input, #direccion_input").hide();
                            }

                            // Seleccionar el botón correspondiente
                            var $button = $("button").eq(i);
                            $button.html("Atendiendo");
                            $button.css("background-color", "#C0C0C0");
                            $button.prop("disabled", true);

                            // Cambiar el estilo de la celda de la fila correspondiente
                            $('tr').eq(i).find('td').eq(1).css("background-color", "#ce0018");
                            $button.on("click", cambiar);
                            $("figure").eq(k).css("display", 'block');


                            function cambiar() {
                                var estadoMesa = $(this).closest("tr").find('.estado_mesa2').val();
                                var tituloMesa = $(this).closest("tr").find('.titulo_mesa').val();
                                var idt = $(this).closest("tr").find('.id_mesa').val();
                                var sumatotal = 0;
                                var contador = 0;
                                var evaluar = 0;
                                var total = 0;
                                var dato = 0;
                                var k = idt - 1;

                                $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion').html('');

                                $('#lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

                                $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento').val("");

                                $("figure").eq(k).css("display", 'block');
                                $('#id_proveedor').val(tituloMesa);
                                $('#mesa_estado').val(estadoMesa);
                                var mesa = $('#id_proveedor').val();

                                if (mesa.trim() === 'Para llevar') {
                                    $("#cliente, #direccion, #clientelb, #direccionlb, #cliente_input, #direccion_input").show();
                                } else {
                                    $("#direccion").val("");
                                    $("#cliente").val("");
                                    $("#guardar, #cliente, #direccion, #clientelb, #direccionlb, #cliente_input, #direccion_input").hide();
                                }

                                $.ajax({
                                    url: "/obtenerComanda/" + mesa, // Obtenemos Comanda Temporal
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        let total = 0;
                                        let base = "0.00";

                                        data.forEach(function(element) {
                                            const articulo = element.articulo;

                                            if (articulo != null) {
                                                $('#detalles').append(`
                                                    <tr class="selected" id="fila${element.fila}">
                                                        <td>
                                                            <button type="button" class="btn btn-warning" onclick="eliminar(${element.fila}, ${element.subtotal})">Eliminar</button>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="articulo[]" value="${element.articulo}">${element.articulo}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="cantidad[]" value="${element.cantidad}">${element.cantidad}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="precio_compra[]" value="${element.precio_compra}">${element.precio_compra}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="subtotal[]" value="${element.subtotal}">${element.subtotal}
                                                        </td>
                                                        <td style="visibility:hidden;">
                                                            <input type="hidden" name="indice" class="indice" value="${element.fila}">
                                                        </td>
                                                    </tr>`
                                                );

                                                total += parseFloat(element.subtotal);
                                                base = total.toFixed(2);

                                                $('#cliente').val(element.cliente);
                                                $('#direccion').val(element.direccion);
                                            } else {
                                                total = 0;
                                                base = total.toFixed(2);
                                            }

                                            const comentario = element.comentario;
                                            $('#comentario').val(comentario != null ? comentario : "");
                                        });

                                        if (total > 0) {
                                            $("#total").html("$" + base);
                                            $('#valor, #total1, #total2').val(base);
                                            $("#guardar").show();

                                            const contador = parseInt(data[data.length - 1].fila) + 1;
                                            $('#incrementa').val(contador);
                                        } else {
                                            resetValues();
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'No se ha podido obtener la comanda!'
                                        });
                                    }
                                });

                                function resetValues() {
                                    $('#total1').val('');
                                    $('#valor, #incrementa').val('0');
                                    $("#total").html("$0.00");
                                    $("#guardar").hide();
                                    $("#comentario").val('');
                                }

                                $('#detalle1, #total').html('');
                            }

                            var j = $("#tableUserList tr").length;
                            for (var x = 0; x < j; x++) {
                                $("button").eq(x).css("background-color", "#C0C0C0").prop("disabled", true);
                            }

                            var elementos = $("input[name='titulo_mesa2']");
                            var estados = $("input[name='estado_mesa2']");
                            for (var y = 0; y < elementos.length; y++) {
                                if ($(elementos[y]).val() == mesa) {
                                    $(estados[y]).val("Abierta");
                                    $(elementos[y]).val("Abierta");
                                }
                            }

                            var data = {
                                "_token": $("meta[name='csrf-token']").attr("content"),
                                "idt": idt,
                                "tituloMesa": tituloMesa
                            };

                            $.ajax({
                                url: "/datosHome", // Abrimos Mesa
                                type: "POST",
                                data: data,
                                success: function(msg) {},
                                error: function(error) {
                                    console.log(error);
                                }
                            });

                        }

                        Swal.fire(
                            'Cerrada!',
                            'La mesa ha sido Cerrada.',
                            'success'
                        );

                    } else {
                        Swal.fire('La mesa sigue Abierta', '', 'info')
                    }

                })
            });

        });
    </script>

    {{-- Ver Mesa --}}
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var total = 0;
            var suma = 0;

            $(document).on('click', '#see_table', function (e) {
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

                // Limpiamos las Etiquetas Superiores
                $('#lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant').html('');
                $('#lbmesa, #lbmesero, #lbcomision, #lbguide, #lbcliente, #lbdireccion').html('');

                // Limpiamos las Etiquetas del Formulario de Pago
                $('#lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario, #lbcomision_price').html('');

                // Reseteamos Valores del Formulario de Pago
                $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #comision_price').val('');

                // Colocamos los Valores de la Mesa en la Pantalla
                $('#id_proveedor').val(tituloMesa);
                $('#mesa_estado').val(estadoMesa);

                var mesa = $('#id_proveedor').val();
                $('figure').eq(k).css('display', 'block');

                if (mesa.trim() == 'Para llevar') {
                    $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").show();
                } else {
                    $("#cliente, #direccion, #cliente_input, #direccion_input, #clientelb, #direccionlb").hide();
                }

                $.ajax({
                    url: "/obtenerComanda/" + mesa, // Obtenemos Comanda Temporal
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        console.log(data);

                        var tableOrden = localStorage.getItem("tableOrden");

                        if(tableOrden != ''){
                            data = JSON.stringify(data);

                            if(data != tableOrden){
                                data = JSON.parse(data);
                                data.forEach(function (element, indice, array) {
                                    var articulo = element.articulo;

                                    if (articulo != null) {
                                        $('#detalles').append(
                                            '<tr class="selected" id="fila' + element.fila + '">' +
                                            '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + element.fila + ',' + element.subtotal + ')">Eliminar</button></td>' +
                                            '<td><input type="hidden" name="articulo[]" value="' + element.articulo + '">' + element.articulo + '</td>' +
                                            '<td><input type="hidden" name="cantidad[]" value="' + element.cantidad + '">' + element.cantidad + '</td>' +
                                            '<td><input type="hidden" name="precio_compra[]" value="' + element.precio_compra + '">' + element.precio_compra + '</td>' +
                                            '<td><input type="hidden" name="subtotal[]" value="' + element.subtotal + '">' + element.subtotal + '</td>' +
                                            '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' + element.fila + '"></td></tr>'
                                        );

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
                                        $('#comentario').val('');
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
                                    var f = data.length - 1;
                                    var dato = data[f].fila;
                                    contador = parseInt(dato) + 1;
                                    $('#incrementa').val(contador);

                                    function evaluar() {
                                        if (base > 0) {
                                            $("#guardar").show();
                                        } else {
                                            $("#guardar").hide();
                                            $("#total").html("$" + "0.00");
                                            $('#total1').val("");
                                        }
                                    }
                                } else {
                                    $('#total1').val("");
                                    $('#conftotal').val("");
                                    $("#total").html("$" + "0.00");
                                    $('#valor').val("0");
                                    $('#incrementa').val("0");
                                    $("#guardar").hide();

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
                                        '<tr class="selected" id="fila' + element.fila + '">' +
                                        '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + element.fila + ',' + element.subtotal + ')">Eliminar</button></td>' +
                                        '<td><input type="hidden" name="articulo[]" value="' + element.articulo + '">' + element.articulo + '</td>' +
                                        '<td><input type="hidden" name="cantidad[]" value="' + element.cantidad + '">' + element.cantidad + '</td>' +
                                        '<td><input type="hidden" name="precio_compra[]" value="' + element.precio_compra + '">' + element.precio_compra + '</td>' +
                                        '<td><input type="hidden" name="subtotal[]" value="' + element.subtotal + '">' + element.subtotal + '</td>' +
                                        '<td style="visibility:hidden;"><input type="hidden" id="indice" name="indice" class="indice" value="' + element.fila + '"></td></tr>'
                                    );

                                    console.log(element);

                                    var mesero = element.mesero_id;
                                    var comensales = element.num_comensales;
                                    var guia = element.guia_id;
                                    $('#mesero').val(mesero);
                                    $('#comensales').val(comensales);
                                    $('#guide').val(guia).trigger('change');

                                    if (guia !== 1) {
                                        const comision = element.comision_percentage || 0;  // Evita valores undefined
                                        $('#comision').val(comision);
                                        calcular();
                                    }

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
                                    $('#comentario').val('');
                                }

                            });

                            evaluar = parseInt(total);

                            if (evaluar != 0) {
                                $("#total").html("$" + base);
                                $('#valor, #total1, #total2, #res, #conftotal').val(base);
                                $("#guardar").show();
                                var f = data.length - 1;
                                var dato = data[f].fila;
                                contador = parseInt(dato) + 1;
                                $('#incrementa').val(contador);

                                function evaluar() {
                                    if (base > 0) {
                                        $("#guardar").show();
                                    } else {
                                        $("#guardar").hide();
                                        $("#total").html("$" + "0.00");
                                        $('#total1').val("");
                                    }
                                }
                            } else {
                                $('#total1, #conftotal').val("");
                                $("#total").html("$" + "0.00");
                                $('#valor, #incrementa').val("0");
                                $("#guardar").hide();

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

                $('#detalle1, #total').html('');

            });

        });
    </script>

    {{-- Funciones - Primera parte del Formulario (Detalles Generales) --}}
    <script type="text/javascript">
        $(document).ready(function () {

            $("#comision_col, #comision_price, #res").hide();

            $("#guide").on("keyup", activateForCommission);
            $("#guide").on("change", activateForCommission);

            function activateForCommission() {
                const guideName = $('#guide').val();
                const shouldShow = (guideName !== "1"); // Comparación como string
                $("#comision_col, #comision_price, #res").toggle(shouldShow);
            }

            $("#comision").on("change", function () {
                // Calcular total (Con propina y Comisión)
                const subtotal = parseFloat($('#res').val()) || 0; // Subtotal SUMA
                const comision = parseFloat($('#comision').val()) || 0; // % de Comisión
                const propina = parseFloat($('#propina').val()) || 0; // Propina

                // Calcular el cobro por comisión
                const cobroComision = (subtotal * comision / 100).toFixed(2);
                $('#comision_price').val(cobroComision);

                // Calcular el total (subtotal + propina + comisión)
                const totalCalculado = (subtotal + propina + parseFloat(cobroComision)).toFixed(2);

                // Actualizar el valor de "total2"
                $('#total2').val(totalCalculado);
            });

        });
    </script>

    {{-- Funciones - Ultima parte del Formulario --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $(".user").hide()

            // Calcular Cambio
            function multiplicar() {
                // Obtener los elementos
                var uno = $('#total2'); // Total Calculado (Con Propina y Comisisón)
                var dos = $('#dos'); // Pago
                var tres = $('#tres'); // Cambio

                // Convertir los valores a números
                var totalc = parseFloat(uno.val()) || 0; // Usar 0 si es NaN
                var valorDos = parseFloat(dos.val()) || 0; // Usar 0 si es NaN

                // Calcular la operación
                var operacion = valorDos - totalc;

                // Actualizar el valor de "tres"
                tres.val(operacion.toFixed(2));
            }

            // Calcular total (Con propina y Comisión)
            function suma() {
                // Obtener los elementos
                const subtotal = parseFloat($('#res').val()) || 0; // Subtotal SUMA
                const comision = parseFloat($('#comision').val()) || 0; // % de Comisión
                const propina = parseFloat($('#propina').val()) || 0; // Propina
                const total2 = $('#total2'); // Total Calculado (Con Propina)

                // Calcular el cobro por comisión
                const cobroComision = (subtotal * comision / 100).toFixed(2);
                $('#comision_price').val(cobroComision);

                // Calcular el total (subtotal + propina + comisión)
                const totalCalculado = (subtotal + propina + parseFloat(cobroComision)).toFixed(2);

                // Actualizar el valor de "total2"
                total2.val(totalCalculado);
            }

            // Total Original sin Modificaciones
            $("#total2").keyup(function () {
                var dos = $('#dos').val();
                if (dos != "") {
                    multiplicar()
                }
            });

            // Pago
            $("#dos").keyup(function () {
                var uno = $('#total2').val();
                if (dos != "") {
                    multiplicar()
                }
            });

            // Subtotal
            $("#res").keyup(function () {
                var propina = $('#propina').val();
                if (propina != "") {
                    suma()
                }
            });

            // Propina
            $("#propina").keyup(function () {
                var res = $('#res').val();
                if (res != "") {
                    suma()
                }
            });

            // Descuento
            $("#desc").keyup(function () {
                var res = $('#desc').val();
                if (res > 0) {
                    $("#motivoDescuento").show();
                } else {
                    $("#motivoDescuento").hide();
                }
            });

        })
    </script>

    {{-- Calcular Total --}}
    <script type="text/javascript">

        function calcular() {
            // Obtener los elemento
            var conftotal = parseFloat($('#conftotal').val()) || 0; // Usar 0 si es NaN
            var propina = parseFloat($('#propina').val()) || 0; // Usar 0 si es NaN
            var num = parseFloat($('#desc').val()) || 0; // Usar 0 si es NaN

            // Calcular el descuento
            var desc = (conftotal * num) / 100;

            // Actualizar los valores en los campos
            $('#res').val((conftotal - desc).toFixed(2));
            $('#descuento1').val(desc.toFixed(2));

            // Actualizar total final
                const subtotal = parseFloat($('#res').val()) || 0; // Subtotal SUMA
                const comision = parseFloat($('#comision').val()) || 0; // % de Comisión

                // Calcular el cobro por comisión
                const cobroComision = (subtotal * comision / 100).toFixed(2);
                $('#comision_price').val(cobroComision);

                // Calcular el total (subtotal + propina + comisión)
                const totalCalculado = (subtotal + propina + parseFloat(cobroComision)).toFixed(2);

                // Actualizar el valor de "total2"
                $('#total2').val(totalCalculado);
        }

    </script>

    {{-- Script para las ventas --}}
    <script type="text/javascript">
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

        $("#guardar").hide();
        $("#cliente").hide();
        $("#direccion").hide();
        $("#cliente_input").hide();
        $("#direccion_input").hide();
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

            var fecha = $('#fecha').val();
            var mesa = $('#id_proveedor').val();
            var estado = $('#mesa_estado').val();
            var cajero = $('#cajero').val();

            var guide = $('#guide').val();
            var comision = $('#comision').val();
            var mesero = $('#mesero').val();
            var comensales = $('#comensales').val();

            var cliente = $('#cliente').val();
            var direccion = $('#direccion').val();
            var comentario = $('#comentario').val();

            if (mesa != "Para llevar") {
                if (id_articulo != "" && cantidad > 0 && precio_compra != "" && mesa != "") {

                    //Borrar los errores.
                    $('#lbmesa').html('');
                    $('#lbprecio_compra').html('');
                    $('#lbcantidad').html('');
                    $('#lbpespecial').html('');
                    $('#lbpesprecio').html('');
                    $('#lbpespcant').html('');

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

                        "guide": guide,
                        "comision": comision,
                        "mesero": mesero,
                        "comensales": comensales,

                        "articulo": articulo,
                        "cantidad": cantidad,
                        "precio_compra": precio_compra,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComanda", // Guardamos Comanda Temporal
                        type: "POST",
                        data: data,
                        success: function (response) {
                            console.log(response);
                            var index = parseInt($('#incrementa').val()) + 1;
                            $('#incrementa').val(index);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 2!',
                            });
                        }
                    });

                    limpiar();

                    $('#lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbcupon, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

                    $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento').val("");
                    $("#pcantidad").val("1");
                    $("#pprecio_compra, #select-categoria, #producto, #comentario").val("");
                    $("#total").html("$" + base);
                    $("#conftotal, #valor, #total1, #total2").val(base);
                    evaluar();
                    $("#detalles").append(fila);

                    reiniciar();
                    calcular();

                } else {

                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo mesa es obligatorio, seleccione la mesa!',
                        });
                        return false;
                    }

                    if (precio_compra == '' || precio_compra <= 0 || isNaN(precio_compra)) {
                        $('#lbprecio_compra').html("<span style='color:red;'>Seleccione un producto</span>");
                        $('#pprecio_compra').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo precio compra es obligatorio, seleccione el producto!',
                        });
                        return false;
                    }

                    if (cantidad == '' || cantidad <= 0 || isNaN(cantidad)) {
                        $('#lbcantidad').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pcantidad').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo cantidad es obligatorio, seleccione la cantidad!',
                        });
                        return false;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al ingresar el detalle del ingreso, revise los datos del artículo!',
                    });
                    return false;

                }
            } else if (mesa == "Para llevar") {
                if (cliente != "" && direccion != "" && id_articulo != "" && cantidad > 0 && precio_compra != "" && mesa != "") {
                    $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion').html('');

                    contador = cantidad * precio_compra;
                    total = parseFloat($('#valor').val());
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

                        "guide": guide,
                        "comision": comision,
                        "mesero": mesero,
                        "comensales": comensales,

                        "articulo": articulo,
                        "cantidad": cantidad,
                        "precio_compra": precio_compra,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComanda", // Guardamos Comanda Temporal
                        type: "POST",
                        data: data,
                        success: function (response) {
                            console.log(response);
                            let index = parseInt($('#incrementa').val()) + 1;
                            $('#incrementa').val(index);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 3!',
                            });
                        }
                    });

                    limpiar();

                    $('#lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbcupon, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

                    $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento').val('');
                    $("#pcantidad").val('1');
                    $("#pprecio_compra, #select-categoria, #producto, #comentario").val('');
                    $("#total").html("$" + base);
                    $("#conftotal, #valor, #total1, #total2").val(base);
                    evaluar();
                    $("#detalles").append(fila);

                    reiniciar();
                    calcular();

                } else {

                    if (mesa.trim() == '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo mesa es obligatorio, seleccione la mesa!',
                        });
                        return false;
                    }

                    if (cliente == '') {
                        $('#lbcliente').html("<span style='color:red;'>Ingrese el cliente</span>");
                        $('#cliente').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo cliente es obligatorio, ingrese el cliente!',
                        });
                        return false;
                    }

                    if (direccion == '') {
                        $('#lbdireccion').html("<span style='color:red;'>Ingrese la dirección</span>");
                        $('#direccion').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo dirección es obligatorio, ingrese la dirección!',
                        });
                        return false;
                    }

                    if (precio_compra == '' || precio_compra <= 0 || isNaN(precio_compra)) {
                        $('#lbprecio_compra').html("<span style='color:red;'>Seleccione un producto</span>");
                        $('#pprecio_compra').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo precio compra es obligatorio, seleccione el producto!',
                        });
                        return false;
                    }

                    if (cantidad == '' || cantidad <= 0 || isNaN(cantidad)) {
                        $('#lbcantidad').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pcantidad').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo cantidad es obligatorio, seleccione la cantidad!',
                        });
                        return false;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al ingresar el detalle del ingreso, revise los datos del artículo!',
                    });
                    return false;

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

            $('#lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbcupon, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

            // $('#cupon').val(""); // Descomentar si es necesario
            $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #select-categoria, #producto, #pprecio_compra, #pcantidad, #pespecial, #pesprecio, #pespcant, #comentario').val('');
            $('#pcantidad, #pespcant').val('1');
        }

        function evaluar() {
            if (base > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index, subtotal) {
            let base = parseFloat($('#valor').val()); // Asegurarse de que sea un número
            base -= subtotal; // Restar el subtotal
            $('#valor').val(base.toFixed(2)); // Guardar el nuevo valor con dos decimales
            $('#conftotal').val(base.toFixed(2)); // Hacer lo mismo para conftotal
            $("#total").html("$" + base.toFixed(2)); // Mostrar el total formateado
            $("#fila" + index).remove(); // Eliminar la fila
            evaluar(); // Pasar base a la función evaluar
        }

        function reiniciar() {
            var k = $("#tableUserList tr").length; // Obtener el número de filas
            var elementos = $("input[name='estado_mesa2']"); // Seleccionar los elementos por nombre

            elementos.each(function(index) {
                var estado = $(this).val(); // Obtener el valor del estado
                var $button = $("button").eq(index + 1); // Seleccionar el botón correspondiente

                if (estado === "Abierta") {
                    $button.css("background-color", "#FFFFFF");
                    $button.prop("disabled", false);
                    $button.html("Ver mesa");
                } else if (estado === "Cerrada") {
                    $button.css("background-color", "#FFFFFF");
                    $button.prop("disabled", false);
                    $button.html("Abrir mesa");
                }
            });
        }

    </script>

    {{--  Script para Boton guardar Comanda --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#guardarComanda").click(function () {
                limpiarSeleccion();
            });
        });

        function limpiarSeleccion() {
            $('#lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbcupon, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').html('');

            $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #select-categoria, #producto, #pprecio_compra, #pcantidad, #pespecial, #pesprecio, #pespcant, #id_proveedor, #comentario').val("");
            $('#pcantidad, #pespcant').val("1");

            $("[name='estado_mesa2']").each(function(index) {
                var button = $("button").eq(index + 1);
                if ($(this).val() == "Abierta") {
                    button.css("background-color", "#FFFFFF").prop("disabled", false).text("Ver mesa");
                } else if ($(this).val() == "Cerrada") {
                    button.css("background-color", "#FFFFFF").prop("disabled", false).text("Abrir mesa");
                }
            });

            // $(location).attr('href', '/home');
        }

    </script>

    {{-- Script para Especialidades --}}
    <script type="text/javascript">
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

            var especialidad = $("#pespecial").val();
            var esprecio = $("#pesprecio").val();
            var espcant = $("#pespcant").val();
            var indice = $('#incrementa').val();

            var fecha = $('#fecha').val();
            var mesa = $('#id_proveedor').val();
            var estado = $('#mesa_estado').val();
            var cajero = $('#cajero').val();

            var guide = $('#guide').val();
            var comision = $('#comision').val();
            var mesero = $('#mesero').val();
            var comensales = $('#comensales').val();

            var cliente = $('#cliente').val();
            var direccion = $('#direccion').val();
            var comentario = $('#comentario').val();

            if (mesa != "Para llevar") {
                if (especialidad != "" && espcant > 0 && esprecio != "" && mesa != "") {

                    esprecio += ".00";

                    $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant').html('');

                    contador = espcant * esprecio;
                    var total = parseFloat($('#valor').val());
                    var suma = total + contador;
                    var base = suma.toFixed(2);
                    var sumatotal = contador.toFixed(2);

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

                        "guide": guide,
                        "comision": comision,
                        "mesero": mesero,
                        "comensales": comensales,

                        "articulo": especialidad,
                        "cantidad": espcant,
                        "precio_compra": esprecio,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComandaExtra", // Guardamos Comanda Extra Temporal
                        type: "POST",
                        data: data,
                        success: function (response) {
                            console.log(response);
                            var index = parseInt($('#incrementa').val()) + 1;
                            $('#incrementa').val(index);
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 4!',
                            });
                        }
                    });

                    limpiar();

                    $("#total").html("$" + base);
                    $('#valor, #total1, #total2, #conftotal').val(base);
                    evaluar();
                    $("#detalles").append(fila);

                    // reiniciar();
                    calcular();

                } else {

                    if (mesa.trim() === '') {
                        $('#lbmesa').html("<span style='color:red;'>Seleccione la mesa</span>");
                        $('#id_proveedor').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo mesa es obligatorio, seleccione la mesa!',
                        });
                        return false;
                    } else if (especialidad.trim() === '') {
                        $('#lbpespecial').html("<span style='color:red;'>Ingrese la especialidad</span>");
                        $('#pespecial').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo producto extra es obligatorio, ingrese la especialidad!',
                        });
                        return false;
                    } else if (!esprecio || esprecio <= 0 || isNaN(esprecio)) {
                        $('#lbpesprecio').html("<span style='color:red;'>Ingrese el precio</span>");
                        $('#pesprecio').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo precio es obligatorio, ingrese el precio!',
                        });
                        return false;
                    } else if (!espcant || isNaN(espcant) || espcant <= 0) {
                        $('#lbpespcant').html("<span style='color:red;'>Seleccione la cantidad</span>");
                        $('#pespcant').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: el campo cantidad es obligatorio, ingrese la cantidad!',
                        });
                        return false;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al ingresar el detalle del ingreso extra, complete los datos!',
                        });
                        return false;
                    }

                }
            } else if (mesa == "Para llevar") {
                if (cliente != "" && direccion != "" && especialidad != "" && espcant > 0 && esprecio != "" && mesa != "") {

                    esprecio += ".00";
                    $('#lbmesa, #lbprecio_compra, #lbcantidad, #lbpespecial, #lbpesprecio, #lbpespcant, #lbcliente, #lbdireccion').empty();
                    contador = espcant * esprecio;
                    total = parseFloat($('#valor').val());
                    base = (total + contador).toFixed(2);
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

                        "guide": guide,
                        "comision": comision,
                        "mesero": mesero,
                        "comensales": comensales,

                        "articulo": especialidad,
                        "cantidad": espcant,
                        "precio_compra": esprecio,
                        "subtotal": sumatotal,
                        "cliente": cliente,
                        "direccion": direccion,
                        "comentario": comentario
                    };

                    $.ajax({
                        url: "/guardarComandaExtra", // Guardamos Comanda Extra Temporal
                        type: "POST",
                        data: data,
                        success: function (response) {
                            $('#incrementa').val(function(i, val) { return parseInt(val) + 1; });
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar 5!',
                            });
                        }
                    });

                    limpiar();

                    $("#total").html("$" + base);
                    $('#valor, #total1, #total2, #conftotal').val(base);

                    evaluar();

                    $("#detalles").append(fila);

                    // reiniciar();
                    calcular();

                } else {

                    const errors = [
                        { condition: mesa.trim() === '', message: 'Seleccione la mesa', element: '#lbmesa', focusElement: '#id_proveedor' },
                        { condition: cliente === '', message: 'Ingrese el cliente', element: '#lbcliente', focusElement: '#cliente' },
                        { condition: direccion === '', message: 'Ingrese la dirección', element: '#lbdireccion', focusElement: '#direccion' },
                        { condition: especialidad.trim() === '', message: 'Ingrese la especialidad', element: '#lbpespecial', focusElement: '#pespecial' },
                        { condition: esprecio === '' || esprecio <= 0 || isNaN(esprecio), message: 'Ingrese el precio', element: '#lbpesprecio', focusElement: '#pesprecio' },
                        { condition: espcant.trim() === '' || isNaN(espcant) || espcant <= 0, message: 'Seleccione la cantidad', element: '#lbpespcant', focusElement: '#pespcant' },
                    ];

                    for (const { condition, message, element, focusElement } of errors) {
                        if (condition) {
                            $(element).html(`<span style='color:red;'>${message}</span>`);
                            $(focusElement).focus();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: `Error el campo ${message.toLowerCase()}, ${message}!`,
                            });
                            return false;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al ingresar el detalle del ingreso extra, complete los datos!',
                    });
                    return false;

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
            $('#lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbcupon, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario').empty();

            $('#cupon, #conftotal, #desc, #res, #propina, #total2, #dos, #tres, #motivoDescuento, #pespcant, #pesprecio, #pespecial, #comentario').val(function() {
                return $(this).is('#pespcant') ? '1' : '';
            });
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
            let base = parseFloat($('#valor').val()) - subtotal;
            $('#valor, #conftotal').val(base);
            $("#total").html(`$${base}`);
            $(`#fila${index}`).remove();

            evaluar();
        }

        function reiniciar() {
            var elementos = $("input[name='estado_mesa2']");
            var botones = $("button");

            elementos.each(function(index) {
                var estado = $(this).val();
                var $boton = botones.eq(index + 1); // Ajuste del índice para acceder al botón correcto

                $boton.css("background-color", "#FFFFFF").prop("disabled", false);

                if (estado === "Abierta") {
                    $boton.text("Ver mesa");
                    $("#cerrar").show("slow");
                } else if (estado === "Cerrada") {
                    $boton.text("Abrir mesa");
                }
            });
        }

    </script>

    {{-- Guardar Orden en la BD ##--}}
    <script type="text/javascript">
        $(document).ready(function () {

            $('.pagar').click(function () {

                    var mesaTitulo = $('#id_proveedor').val(); // Mesa atendida
                    var conftotal = $('#conftotal').val(); // Total Original sin Modificaciones
                    var total = $('#total');
                    var total1 = total.html();
                    var cadena = total1.substring(1);
                    var tot = parseInt(cadena);
                    var res = parseInt($('#res').val()); // Total Calculado (Sin Propina)
                    var dos = parseInt($('#dos').val()); // Pago
                    var tcomanda = parseInt($('#total1').val());
                    var total3 = parseInt($('#total2').val()); // Total Calculado (Con Propina)
                    var descuento = $('#desc').val();

                    if (descuento === '' || isNaN(descuento) || descuento === null) {
                        descuento = 0;
                    }

                    var descuento1 = parseInt(descuento);
                    var propina = $('#propina').val();

                    if (propina === '' || isNaN(propina) || propina === null) {
                        propina = 0;
                    }

                    var propina1 = parseInt(propina);
                    var tres = parseInt($('#tres').val()); // Cambio
                    var motivoDescuento = $('#motivoDescuento').val();
                    var desUser = $('#userDescuento').val();
                    var desU = parseInt(desUser);
                    var formaPago = $('#forma_pago').val();

                    var guide = $('#guide').val();
                    var comision = $('#comision').val();
                    var mesero = $('#mesero').val();

                    if (formaPago == null || formaPago.trim() == '' || formaPago == 0) {
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
                    } else if (res == 0 || res == null || isNaN(res)) {
                        $('#lbres').html(
                            "<span style='color:red;'>El subtotal no puede ser menor al importe</span>");
                        $('#res').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el subtotal no puede ser menor al importe, verifique sus datos!',
                        })
                        return false;
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
                    } else if (dos == null || isNaN(dos)) {
                        $('#lbdos').html("<span style='color:red;'>El pago es incorrecto</span>");
                        $('#dos').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el pago es incorrecto, ingrese un valor válido!',
                        })
                        return false;
                    } else if (tres == null || isNaN(tres)) {
                        $('#lbtres').html("<span style='color:red;'>El valor es incorrecto</span>");
                        $('#tres').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error el valor es incorrecto, verifique sus datos!',
                        })
                        return false;
                    } else if (guide == null || guide.trim() == '' || guide == 0) {
                        $('#lbguide').html("<span style='color:red;'>Nombre requerido</span>");
                        $('#guide').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: El nombre del Guia es obligatorio!',
                        })
                        return false;
                    } else if (
                        (guide == null || guide.trim() == '' || guide == 0)
                        && (comision == null || isNaN(comision))
                    ) {
                        $('#lbcomision').html("<span style='color:red;'>% de Comisión requerido</span>");
                        $('#comision').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: La Comisión del Guia es obligatoria!',
                        })
                        return false;
                    } else if (mesero == null || mesero.trim() == '') {
                        $('#lbmesero').html("<span style='color:red;'>Nombre requerido</span>");
                        $('#mesero').focus();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error: El nombre del Mesero es obligatorio!',
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
                                    url: "{{ route('ComandaHome.store') }}", // Guardamos todo el Pedido
                                    type: "POST",
                                    data: $('#sample_venta').serialize(),
                                    success: function (data) {
                                        location.reload();
                                        window.open('/ticket', 'width=1000,height=800');
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

                                $('#conftotal, #desc, #res, #propina, #total2, #dos, #tres, #total1, #id_proveedor, #direccion, #cliente, #comentario, #motivoDescuento').val("");
                                $("#total").html("$0.00");
                                $('#incrementa').val("0");
                                $('#valor').val("0");

                                $("#guardar, #cliente_input, #direccion_input, #cliente, #direccion, #clientelb, #direccionlb, #motivoDescuento").hide();

                                // Reseteamos valores
                                $('#detalle1, #total, #lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbmotivoDescuento, #lbcomentario, #lbpago').empty();

                                $("#lbcupon, #lbconf_total, #lbdesc, #lbres, #lbpropina, #lbtotal2, #lbdos, #lbtres, #lbpago").hide();

                                Swal.fire(
                                    'Pagado!',
                                    'Orden finalizada, ' + mesaTitulo + ' disponible.',
                                    'success'
                                );

                                var data = {
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                    "tituloMesa": mesaTitulo
                                };

                                $.ajax({
                                    url: "/estadoHome", // Cerramos Mesa
                                    type: "POST",
                                    data: data,
                                    sucess: function (msg) {},
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });

                                const elementos = $("input[name='titulo_mesa2']");
                                const estados = $("input[name='estado_mesa2']");

                                elementos.each(function (index) {
                                    const j = index + 1;
                                    if ($(this).val() === mesaTitulo) {
                                        $(`tr:eq(${j}) td:eq(1)`).css("background-color", "#008000");
                                        $(`button:eq(${j})`).css("background-color", "#FFFFFF").prop("disabled", false).text("Abrir mesa");
                                        estados.eq(index).val("Cerrada");
                                        $("label").eq(index).hide();
                                    } else {
                                        $(`button:eq(${j})`).prop("disabled", false);
                                    }
                                });

                                location.reload();
                            }

                        });

                    }
            });

        });

    </script>

    {{-- Buscador por Selects Dinamicos--}}
    <script type="text/javascript">
        $(document).ready(function () {

            var rsubcategoria = $('#rsubcategoria').val();

            if (rsubcategoria != 'Si') {

                $('#select_categoria').on('input', function () {
                    var id_categoria = $('#select_categoria').val();

                    $.ajax({
                        url: "/productos/" + id_categoria, // Obtenemos los Productos por Categoria
                        type: "GET",
                        dataType: "json",
                        error: function (error) {
                            console.log(error);
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

                $('#select_categoria').on('input', function () {
                    var id_categoria = $('#select_categoria').val();

                    $.ajax({
                        url: "/subcategory/" + id_categoria, // Obtenemos las Subcategorias
                        type: "GET",
                        dataType: "json",
                        error: function (error) {
                            console.log(error);
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
                        url: "/productos/" + id_categoria, // Obtenemos los Productos por Subcategoria
                        type: "GET",
                        dataType: "json",
                        error: function (error) {
                            console.log(error);
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

            $('#producto').on('input', function () {
                var id_producto = $('#producto').val();
                $.ajax({
                    url: "/precio/" + id_producto, // Obtenemos el Precio del Producto
                    type: "GET",
                    dataType: "json",
                    error: function (element) {},
                    success: function (respuesta) {
                        $("#pprecio_compra").val(respuesta.precio);
                        $('#pid_articulo').val(respuesta.titulo);
                    }
                });
            });

        });
    </script>

    {{-- Eliminar Producto Registrado en Orden --}}
    <script type="text/javascript">

        function evaluar() {
            base = $('#valor').val();
            if (base > 0) {
                $("#guardar").show();
            } else {
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

                    // Restamos la Cantidad del Total por Consumo
                    let base = $('#total1').val() - subtotal1;

                    // ## - Total for Products - Total Calculado (Con Propina y Comisión) - Total Original sin Modificaciones
                    $('#valor, #total1, #conftotal, #res').val(base);
                    $("#total").text(`$${base}`);
                    $(`#fila${index}`).remove();

                    evaluar(); // Mostramos Boton?

                    calcular();// Calculamos Descuento y Valores siguientes

                    // Eliminamos la Fila
                    const motivo = $('#swal-input1').val();
                    eliminarFila(index, motivo);

                    Swal.fire('Eliminado!', 'El producto ha sido eliminado.', 'success');

                }

            })
        }

        function eliminarFila(index, motivo) {
            const mesa = $('#id_proveedor').val();
            const estado = $('#mesa_estado').val();

            var data = {
                "indice": index,
                "mesa": mesa,
                "estado": estado,
                "motivo": motivo,
            };

            $.ajax({
                url: "/eliminarFila", // Eliminamos Comanda Temporal
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

    {{-- Buscador de Productos --}}
    <script type="text/javascript">

        $(function () {
            $('#product_name').on('input', onSelectChange);
        });

        function onSelectChange() {
            const product_name = $(this).val();

            if (product_name.length >= 1) {
                $('#showProducts').empty();
            }
            if (product_name.length > 1) {
                $.get(`api/producto/${product_name}/titulo`, function (data) {
                    const html_select = data.map(product => `
                        <button type="button" id="productResult" class="pt-0 pb-0 list-group-item list-group-item-action pe-0" onclick="onSelectProducto(${product.id})">
                            ${product.titulo}
                        </button>
                    `).join('');
                    $('#showProducts').html(html_select);
                });
            }
        }

        function onSelectProducto(id) {
            $('#showProducts').empty();

            $.get(`api/producto/${id}/producto`, function (data) {
                const { precio, id: id_prod, titulo: name_prod } = data[0];

                const producto = `<option selected="selected" value="${id_prod}">${name_prod}</option>`;
                $('#producto').empty().append(producto);

                $('#pid_articulo').val(name_prod);
                $('#pprecio_compra').val(precio);
            });
        }

    </script>

    {{-- Get By Apis --}}
    <script type="text/javascript">
        // On window load
        window.onload = function () {
            localStorage.setItem("PaymentMethods", '');
            localStorage.setItem("Tables", '');
            getPayMethods();
            getTables();
        }

        // On window unload
        window.onbeforeunload = function () {
            localStorage.removeItem("PaymentMethods");
            localStorage.removeItem("tableOrden");
            localStorage.removeItem("Tables");
        };

        // Cargar Métodos de PAgo
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
            setInterval(getPayMethods, 90000); // Cada 1 minuto y medio (90 mil milisegundos)
        });

        // Renderizar Tabla (Mesas)
        function generateTableRow(data) {
            let viewOfButton = '';

            if (data.estado !== 'Abierta') {
                viewOfButton += `
                    <button type="button" id="open_table" class="btn btn-info" target="_blank">Abrir mesa</button>
                    <figure id="elem" name="elem" style="display:none; cursor: pointer;" class="mt-2 mb-0">
                        <a id="close_table" name="cerrar" class="cerrar">
                            <img src="/img/papelera.png" height="25" width="25">Cerrar
                        </a>
                    </figure>
                `;
            } else {
                viewOfButton += `
                    <button type="button" id="see_table" class="btn btn-info" target="_blank">Ver mesa</button>
                    <figure id="elem" name="elem" class="mt-2 mb-0 btn" style="cursor: pointer;">
                        <a id="close_table" name="cerrar" class="cerrar">
                            <img src="/img/papelera.png" height="25" width="25">Cerrar
                        </a>
                    </figure>
                `;
            }

            return `
                <tr>
                    <input type="hidden" class="id_mesa" value="${data.id}">
                    <input type="hidden" class="titulo_mesa" value="${data.titulo}">
                    <input type="hidden" id="estado_mesa" name="estado_mesa" class="estado_mesa" value="${data.estado}">
                    <td class="filaMesa" style="vertical-align:middle;">${data.titulo}</td>
                    <td bgcolor="${data.color}"></td>
                    <td class="text-center">${viewOfButton}</td>
                    <td style="visibility:hidden;">
                        <input type="hidden" id="estado_mesa2" name="estado_mesa2" class="estado_mesa2" value="${data.estado}">
                    </td>
                    <td style="visibility:hidden;">
                        <input type="hidden" id="titulo_mesa2" name="titulo_mesa2" class="titulo_mesa2" value="${data.titulo}">
                    </td>
                </tr>
            `;
        }

        function updateTables(data) {
            let html_select = '';
            data.forEach(item => {
                html_select += generateTableRow(item);
            });
            $('#mesaStatus').html(html_select);
            localStorage.setItem("Tables", JSON.stringify(data));
        }

        function getTables() {
            let tables = localStorage.getItem("Tables");

            $.get('api/tables', function (data) {
                const dataString = JSON.stringify(data);

                // Si hay tablas guardadas en localStorage
                if (tables && tables !== dataString) {
                    updateTables(data);
                }
                // Si no hay tablas en localStorage
                else if (!tables) {
                    updateTables(data);
                }
            });
        }
        $(document).ready(function () {
            setInterval(getTables, 90000); // Cada 1 minuto y medio (90 mil milisegundos)
        });

    </script>

@endsection
