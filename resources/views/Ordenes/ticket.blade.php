@extends('layouts.app')
@section('content')
<link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
<img src="../img/imagenes-07.png" alt="" width="120" height="40">
    <div class="ticket">
        <p class="centrado">
             TICKET DE VENTA
            @if($restaurante['id'] != 0)
            @if($restaurante['nombre'] != '')
            <br>{{$restaurante['nombre']}}
            @endif
            @if($restaurante['rfc'] != '')
            <br>{{$restaurante['rfc']}}
            @endif
            @endif
            <br>Sucursal 01
            <br>{{ $orden->created_at}}
            <br>Folio: &nbsp;{{ $orden->id }}
            <br>Mesa : {{ $orden->mesa}}
            <br>Atendido por: &nbsp;{{ $orden->cajero}}
            <br>Forma de pago: &nbsp;{{ $orden->forma_pago}}
            @if($orden->mesa == 'Para llevar')
            <br>Cliente: &nbsp;{{ $orden->cliente}}
            <br>Dirección: &nbsp;{{ $orden->direccion}}
            @endif
        </p>

        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                    <th class="subtotal">Subtotal</th>
                </tr>
            </thead>

            <tbody>
               @foreach($pedido as $pedido)
                <tr>
                    <td class="cantidad">{{ $pedido->cantidad  }}</td>
<!--                    <td class="producto"> $pedido->titulo }}</td>-->
                    <td class="producto">{{ $pedido->articulo }}</td>
                    <td class="precio">${{ $pedido->precio_compra }} </td>
                    <td class="subtotal">${{ $pedido->subtotal }}</td>
                </tr>
                @endforeach
                @foreach($detalle as $detalle)
                    <td class="cantidad">{{ $detalle->cant }}</td>
                    <td class="producto">{{ $detalle->producto }}</td>
                    <td class="precio">${{ $detalle->precio_c }} </td>
                    <td class="subtotal">${{ $detalle->sub_total }}</td>
                @endforeach
            </tbody>

        </table>
          <br>
           <p class="centrado">
                 IMPORTE: &nbsp;${{ $orden->conf_total}}
                  @if($orden->descuento != null)
                  <br>DESCUENTO: &nbsp;{{ $orden->descuento}} %
                  @endif
                  @if($orden->total != null)
                  <br>SUBTOTAL: &nbsp;${{ $orden->total}}
                  @endif
                  @if($orden->propina != null)
                  <br> PROPINA: &nbsp;${{ $orden->propina}}
                  @endif
                  {{-- @if($orden->cupon != null)
                 <br>CUPÓN: &nbsp;${{ $orden->cupon}}
                  @endif --}}
                  <br>TOTAL:   &nbsp;${{ $orden->total2}}
                  <br>RECIBIDO:   &nbsp;${{ $orden->pago}}
                  <br>CAMBIO:   &nbsp;${{ $orden->cambio}}

           </p>
           <p class="centrado">¡GRACIAS POR SU PREFERENCIA! <br>
            @if($restaurante['id'] != 0)
            @if($restaurante['email'] != '')
            <br>CORREO: {{$restaurante['email']}}
            @endif
            @if($restaurante['facebook'] != '')
            <br>FACEBOOK: {{$restaurante['facebook']}}
            @endif
            @if($restaurante['instagram'] != '')
            <br>INSTAGRAM: {{$restaurante['instagram']}}
            @endif
            @if($restaurante['twitter'] != '')
            <br>TWITTER: {{$restaurante['twitter']}}
            @endif
            @if($restaurante['youTube'] != '')
            <br>YOUTUBE: {{$restaurante['youTube']}}
            @endif
            @if($restaurante['linkedIn'] != '')
            <br>LINKEDIN: {{$restaurante['linkedIn']}}
            @endif
            @endif
            </p>

    </div>
    <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
    <button class="oculto-enviar" onclick="enviar()">Enviar por correo</button>

@endsection
@section('ticket')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function imprimir() {
      window.print();
    }

  function enviar() {
  const { value: email } =Swal.fire({
  title: 'Ingrese el correo electrónico del cliente',
  input: 'email',
  inputPlaceholder: 'Ingrese correo electrónico',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: 'Enviar ticket!',
   inputValidator: (result) => {
    //re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
   expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!expr.test(result)){
    return 'Dirección de correo electrónico inválida'
  }
  }
   }).then((result) => {
  var email=result.value;
  if (result.isConfirmed) {

     var data ={
        "_token":$("meta[name='csrf-token']").attr("content"),
        "email":email
     };
    $.ajax({
                url: "/enviarTicket",
                type: "POST",
                data: data,
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                   console.log(error);
                   Swal.fire({
                   icon: 'error',
                   title: 'Error!',
                   text: 'No se ha podido enviar el correo!',
                    })
                }
            });
        Swal.fire(
       'Enviado!',
       'El ticket se ha enviado al correo: '+email,
       'success'
       )
  }
   })

     }
</script>
@endsection

