@extends('layouts.master')
@section('content')

<div class="container">
<div class="row">
   <!--Mesas-->
    <div class="col-sm-3">
        <div class="row">
            <table id="tableUserList" class="table table-striped table-bordered table-responsive-md" style="margin-top:10px;">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th style="width:1%">Estado</th>
                        <th scope="col">Acción</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($mesas as $mesas)
                        @if($mesas->titulo != 'Para llevar')
                        <tr>
                            <input type="hidden" class="id_mesa" value="{{$mesas->id}}">
                            <td>{{$mesas['titulo']}}</td>
                            <td bgcolor="{{$mesas['color']}}"></td>
                            <td>
                            @if($mesas->estado != 'Abierta')
                            @if($mesas->id == $comanda->id)
                            <button type="button" id="mesa" class="btn btn-info mesabtn"  data-href="/paneledit/{{$mesas->id}}" target="_blank">
                                Abrir mesa
                            </button>
                            @else
                            <button type="button" disabled="true" id="mesa" class="btn btn-info mesabtn"  data-href="/paneledit/{{$mesas->id}}" target="_blank">
                                Abrir mesa
                            </button>
                            @endif
                            @else
                            @if($mesas->id == $comanda->id)
                            <button type="button" id="mesa" class="btn btn-info mesabtn"  data-href="/paneledit/{{$mesas->id}}" target="_blank">
                                Ver mesa
                            </button>
                            @else
                            <button type="button" id="mesa" disabled="true" background-color: grey; color: #666666; class="boton_1 mesabtn"  data-href="/paneledit/{{$mesas->id}}" target="_blank">
                                Ver mesa
                            </button>
                            @endif
                            </td>
                            @endif
                            
                            
                            <!-- <input type="text" class="serdelete_val" name="num_oficio" id="num_oficio"  value="{{$mesas->id}}" readonly=""> -->
                            
                        </tr>
                        @endif
                        
                    <!-- Modal   data-toggle="modal" data-target="#edit-modal{{ $mesas->id}}" -->
<!--
                    <div class="modal fade" id="edit-modal{{ $mesas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Abrir la comanda de esta mesa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action=" route('panel.update', $mesas->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Titulo </label>
                                            <div class="col-md-8">
                                                <input type="text" name="titulo" id="titulo" value="{{ $mesas->titulo }}" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Estado </label>
                                            <div class="col-md-8">
                                                <select id="estado" type="text" class="form-control" name="estado" value="{{ old('estado_id') }}" required>
                                                    <option value="Abierta">Abierta</option>
                                                    <option value="Cerrada">Cerrada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class=" offset-md-6">
                                                <button type="s" class="btn btn-primary">
                                                    {{ __('Guardar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
-->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 <!--Fin Mesas--> 
  
 <div class="col-sm-9">

 <form method="POST" action="{{ route('Pedido.store') }}" id="sample_venta" class="form-horizontal" enctype="multipart/form-data">
  <div class="card border-dark" style="margin-top:10px">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>" required readonly="readonly" style="background-color:#FFF;cursor: no-drop;">
                </div>
            </div><!-- fin col-md-3 -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="mesa">Mesa</label>
                    <select name="mesa" id="id_proveedor" class="form-control selectpicker" data-live-search="true" disabled required readonly="readonly" style="background-color:#FFF;cursor: no-drop;">
                    <option value="{{$comanda->titulo}}"  selected ="" >{{$comanda->titulo}} </option>
                        @foreach($mesa as $mesa)
                           @if($mesa->titulo != 'Para llevar')
                            <option value="{{ $mesa->titulo }}" >{{ $mesa->titulo }}</option>
                           @endif
                        @endforeach
                    </select>
                </div>
            </div><!-- fin col-md-3 -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cajero">Atiende</label>
                    <input readonly="readonly" style="background-color:#FFF;cursor: no-drop;"  id="cajero" type="text" class="form-control" name="cajero" value="{{Auth::user()->name}}" required>
                </div>
            </div><!-- fin col-md-3 -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cajero">Forma de pago</label>
                    <select class="form-control" name="forma_pago" id="forma_pago" required>
                        <option value="">Seleccionar</option>
                        @foreach($paymethod as $paymethod)
                            <option value="{{ $paymethod->titulo}}">{{ $paymethod->titulo }}</option>
                        @endforeach
                    </select>
                </div>
            </div><!-- fin col-md-3 -->
        </div>
    </div>
</div>

<!--Comanda-->
 <div class="row">
  <div class="col-sm-12">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <div class="card border-success" style="margin-top:10px">
            <div class="card-body">
                <div class="row">
                   <!-- Seccion 1 -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="articulo">Categoria</label>
                            <select id="select-categoria" size="4" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccionar</option>
                                @foreach($cta as $cta)
                                    <option value="{{ $cta->id }}">{{ $cta->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="articulo">Producto</label>
                            <select id="producto"  size="5" class="form-control selectpicker" data-live-search="true">
                                <option value="">Seleccionar</option>
                            </select>
                            <input id="pid_articulo"  class="form-control user" type="text">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pprecio_compra">Precio Compra</label>
                            <input id="pprecio_compra" value="" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pcantidad">Cantidad</label>
                            <input type="number" min="1" max="9" id="pcantidad" class="form-control" value="1">
                        </div>
                    </div>

                    <div class="col-md-2" style="margin-top:30px">
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-warning">
                                Registrar
                            </button>
                        </div>
                    </div>

                    <!--  Sección 2 -->

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="articulo">Producto extra</label>
                            <input type="text" id="pespecial" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pprecio_compra">Precio</label>
                            <input type="text" id="pesprecio" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pcantidad">Cantidad</label>
                            <input type="number" min="1" max="9" id="pespcant" class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-top:30px">
                        <div class="form-group">
                            <button type="button" id="agrega" class="btn btn-warning">
                                Registrar
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="detalles" class="table table-bordered table-striped table-hover" style="margin-top: 10px">
                            <thead class="table-success">
    <!--                        style="background-color: #A9D0F5"-->
                            <th>Acciones</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            {{--<th>Precio Venta</th>--}}
                            <th>Subtotal</th>
                            </thead>
                            <tfoot>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            {{--<th></th>--}}
                            {{--<th><span id="total">0.00</span></th>--}}
                            <th>
                                <h1 id="total">0.00</h1>
                                <input id="conftotal" class="form-control" name="conf_total" placeholder="Confirma el importe" style="" autocomplete="off" required>
                                <input id="desc" class="form-control" name="descuento" placeholder="Descuento o ponga 0" style="margin-top:5px;" autocomplete="off" required>
                                <input type="button" class="btn btn-success btn-sm form-control" value="{{ __('Calcular Total') }}" onclick="calcular()" style="margin-top:5px;">
                                <input id="res" class="form-control" name="total" autocomplete="off" placeholder="Subtotal" required style="margin-top:5px;" required>
                                <input id="propina" class="form-control" name="propina" placeholder="Agrega propina o ponga 0" style="margin-top:5px;" autocomplete="off" required>
                                <input id="total2" class="form-control" name="total2" autocomplete="off" placeholder="Total" required style="margin-top:5px;font-weight: bold;" required>
                                <input id="dos" class="form-control" name="pago" placeholder="Pago" style="margin-top:5px;" autocomplete="off" required>
                                <input id="tres" class="form-control" name="cambio" placeholder="Cambio" style="margin-top:5px;" autocomplete="off" required>
                            </th>
                            {{--<th></th>--}}
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="row">
                        <div class="col-md-12" align="center" id="guardar">
                        <div class="form-group">
                            <button class="btn btn-primary form-control" type="submit">
                                Guardar
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
        <div class="row">
        </div><!-- fin row buttons -->
        </div>
<!--  Fin comanda -->

</div>
</form>
</div>   


</div>  <!-- row -->
</div>
@endsection
@section('comando')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
         $(".user").hide()

        function multiplicar() {

            var uno, dos, tres, operacion;

            uno = $('#total2');
            dos = $('#dos');
            tres = $('#tres');

            operacion = parseFloat(dos.val()) - parseFloat(uno.val());
//            tres.val(operacion);
            document.getElementById("tres").value = operacion.toFixed(2);

        }
        
        
        function suma(){
            var propina, subtotal,operacion2,total2;
            propina = $('#propina')
            subtotal = $('#res')
            total2 = $('#total2')
            
            operacion2 = parseFloat(propina.val()) + parseFloat(subtotal.val());
            document.getElementById("total2").value = operacion2.toFixed(2);
        }

        $("#total2").keyup(function() {

            var dos;
            dos = $('#dos').val();

            if (dos != "") {
                multiplicar()
            }

        });

        $("#dos").keyup(function() {

            var uno;
            uno = $('#total2').val();

            if (dos != "") {
                multiplicar()
            }

        });
        
        $("#res").keyup(function() {

            var propina;
            propina = $('#propina').val();

            if (propina != "") {
                suma()
            }

        });

        $("#propina").keyup(function() {

            var res;
            res = $('#res').val();

            if (res != "") {
                suma()
            }

        });


    })

</script>
 
<!--   Script para el calculo del total -->
<script>
       function calcular() {
        var conftotal = document.getElementById('conftotal').value;
        var propina = document.getElementById('propina').value;
        var num = document.getElementById('desc').value;
        var sum = parseInt(conftotal);
        var desc = (sum * num) / 100;
        var sum2 =  parseInt(propina);
        document.getElementById("res").value = conftotal - desc;
    }
</script>
{{--script para las ventas--}}
<script>
    $(document).ready(function(){
        $("#bt_add").click(function(){
            agregar();
        });
    });

    var cont = 0;
    var total = 0;
    var subtotal = [];

    //Cuando cargue el documento
    //Ocultar el botón Guardar
    $("#guardar").hide();

    function agregar(){
        //Obtener los valores de los inputs
        id_articulo = $("#pid_articulo").val();
//        articulo = $("#pid_articulo option:selected").text();
        articulo = $("#pid_articulo").val();
        cantidad = $("#pcantidad").val();
        precio_compra = $("#pprecio_compra").val();


        // precio_venta = $("#pprecio_venta").val();

        //Validar los campos
        if(id_articulo != "" && cantidad > 0 && precio_compra != ""){

            //subtotal array inicie en el indice cero
            subtotal[cont] = (cantidad * precio_compra);
            total = total + subtotal[cont];

            var fila = '<tr class="selected" id="fila'+cont+'">' +
                       '<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">Eliminar</button></td>' +
//                           '<td><input type="hidden" name="articulo_id[]" value="'+id_articulo+'">'+articulo+'</td>' +
                       '<td><input type="hidden" name="articulo[]" value="'+id_articulo+'">'+articulo+'</td>' +
                       '<td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td>' +
                       '<td><input type="hidden" name="precio_compra[]" value="'+precio_compra+'">'+precio_compra+'</td>' +
                       '<td><input type="hidden" name="subtotal[]" value="'+subtotal[cont]+'">'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $("#total").html("$" + total);
            // document.getElementById('total').value = total;
            evaluar();
            $("#detalles").append(fila);
        }else{
            swal ( "Oops","Error al ingresar el detalle del ingreso, revise los datos del artículo","error" )
           // $('#mesa').prop("disabled",true);
        }

    }

    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
        // $("#pprecio_venta").val("");
    }
    function evaluar(){
        if(total > 0){
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }
    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html("$" + total);
        $("#fila" + index).remove();
        evaluar();
    }
</script>
<!--  Script para Especialidades  -->
<script>
    $(document).ready(function(){
        $("#agrega").click(function(){
            agrega();
        });
    });

    var cont = 0;
    var total = 0;
    var subtotal = [];

    function agrega(){

        especialidad = $("#pespecial").val();
        esprecio = $("#pesprecio").val();
        espcant = $("#pespcant").val();

        if(especialidad != "" && espcant > 0 && esprecio != ""){

            subtotal[cont] = (espcant * esprecio);
            total = total + subtotal[cont];

            var fila = '<tr class="selected" id="fila'+cont+'">' +
                       '<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">Eliminar</button></td>' +
                       '<td><input type="hidden" name="articulo[]" value="'+especialidad+'">'+especialidad+'</td>' +
                       '<td><input type="hidden" name="cantidad[]" value="'+espcant+'">'+espcant+'</td>' +
                       '<td><input type="hidden" name="precio_compra[]" value="'+esprecio+'">'+esprecio+'</td>' +
                       '<td><input type="hidden" name="subtotal[]" value="'+subtotal[cont]+'">'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $("#total").html("$" + total);
            evaluar();
            $("#detalles").append(fila);
        }else{
            swal ( "Oops","Error al ingresar el detalle del ingreso extra, Complete los datos","error" )
           // $('#mesa').prop("disabled",true);
        }

    }
    function limpiar(){
        $("#pespcant").val("");
        $("#pesprecio").val("");
        $("#pespecial").val("");
        // $("#pprecio_venta").val("");
    }
    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html("$" + total);
        $("#fila" + index).remove();
        evaluar();
    }
</script>
<script>
    $(function(){
        $('#select-categoria').on('change', onSelectChange);
        $('#producto').on('change',onSelectProducto);
        $('#producto').on('change',onSelectName);
    });

    function onSelectChange() {
        var categoria_id = $(this).val();
        if (!categoria_id)
            $('#producto').html('<option value="">Seleccionar</option>');

        $.get('api/Proyecto/' + categoria_id + '/titulo', function(data) {
            var html_select = '<option value="">Seleccionar</option>';
            for (var i = 0; i < data.length; ++i)
                html_select += '<option value=" '+ data[i].id + '" >' + data[i].titulo+ '</option>';
                $('#producto').html(html_select);  
        });
    }

    function onSelectProducto(){
        var id = $(this).val();        
         $.get('api/producto/' + id + '/producto', function(data){
            var html_select = '';
            for (var i = 0; i < data.length; ++i)
            html_select += (data[i].precio) ;
            $('#pprecio_compra').val(html_select);

         });
        
    }
    
    function onSelectName(){
        var name = $(this).val();        
         $.get('api/producto/' + name + '/producto', function(datas){
            var html_select = '';
            for (var a = 0; a < datas.length; ++a)
            html_select += (datas[a].titulo);
          $('#pid_articulo').val(html_select);

         });
        
    }

</script>
@endsection
