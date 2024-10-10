<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">

    <title>Ticket de Venta | {{ $orden->id }}</title>

    {{-- Boostrap --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    {{-- My Styles --}}
    <style>
        .ticket {
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
            font-size: 12px;
        }

        .ticket table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        .ticket th,
        .ticket td {
            border-bottom: 1px solid #000;
            padding: 4px;
        }

        .ticket th {
            text-align: left;
        }
        .ticket td {
            text-align: center;
        }

        /* Estilos específicos para la impresión */
        @media print {
            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .ticket {
                box-shadow: none;
                border: none;
                margin: 0 auto;
            }

            .oculto-impresion {
                display: none;
            }
        }
    </style>
</head>

<body class="py-4 text-center">
    <div class="rounded ticket">
        <img src="{{ asset('img/imagenes-07.png') }}" alt="Harsi Logo" width="140" height="50">

        <p class="pt-2 text-center">

            @if($restaurante->nombre != '')
                <b class="pb-0 mb-0 text-uppercase" style="font-size: 1.1rem !important">{{$restaurante->nombre}}</b>
                <br>
            @endif
            <span style="font-size: 0.65rem !important">- TICKET DE VENTA -</span>

        <p class="px-2 text-left">

            Folio: &nbsp;{{ $orden->id }}

            @if($restaurante->direccion != '')
                <br>
                Calle:  &nbsp;<span class="text-uppercase">{{$restaurante->direccion}}</span>
            @endif

            @if($restaurante->rfc != '')
                <br>
                RFC:  &nbsp;<span class="text-uppercase">{{$restaurante->rfc}}</span>
            @endif


            <br><br>Mesa:  &nbsp;<span class="text-uppercase">{{ $orden->mesa }} -- {{ $orden->num_comensales }} Comensales</span>
            <br>Turno:  &nbsp;<span class="text-uppercase">{{ $orden->turno }}</span>

            <br>Atendío &nbsp;<span class="text-uppercase">{{ $orden->mesero }}</span>
            <br>Cobró: &nbsp;<span class="text-uppercase">{{ $orden->cajero }}</span>

            @if($orden->guia != 'Ninguno')
                <br>Guía: &nbsp;<span class="text-uppercase">{{ $orden->guia }}</span>
            @endif

            <br>Fecha: {{ $orden->created_at }}

            @if($orden->mesa == 'Para llevar')
                <br><br>Cliente: &nbsp;<span class="text-uppercase">{{ $orden->cliente }}</span>
                <br>Dirección: &nbsp;<span class="text-uppercase">{{ $orden->direccion }}</span>
            @endif


        </p>
        <table class="mt-2 mb-3">
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                    <th class="subtotal">IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="cantidad">{{ $pedido->cantidad }}</td>
                        <td class="text-left producto">{{ $pedido->articulo }}</td>
                        <td class="precio">${{ $pedido->precio_compra }}</td>
                        <td class="subtotal">${{ $pedido->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-center">

            Número de Articulos: &nbsp;{{ $pedido_count }}
            <br>Forma de Pago: &nbsp;{{ $orden->forma_pago }}

            @if($orden->descuento != null)
                <br>Importe: &nbsp;${{ $orden->conf_total }}
                <br>Descuento: &nbsp;{{ $orden->descuento }} %
            @endif

            @if($orden->guia != 'Ninguno')
                <br>Subtotal: &nbsp;${{ $orden->total }}
                <br>
                Importe por Guia ({{ $orden->comision_percentage }}%):
                &nbsp;${{ $orden->comision }}
            @endif

            @if($orden->propina != null)
                <br>Propina: &nbsp;${{ $orden->propina }}
            @endif

            <br><b>Total: &nbsp;${{ $orden->total2 - $orden->propina }} M.N</b>
            <br>Pago: &nbsp;${{ $orden->pago }}
            <br>Cambio: &nbsp;${{ $orden->cambio + $orden->propina }}
        </p>

        <p class="text-center">¡GRACIAS POR SU PREFERENCIA!
            @if($restaurante->telefono != '')
            <br>Telefono: {{$restaurante->telefono}}
            @endif
            @if($restaurante->email != '')
            <br>Correo: {{$restaurante->email}}
            @endif
            @if($restaurante->facebook != '')
            <br>Facebook: {{$restaurante->facebook}}
            @endif
            @if($restaurante->instagram != '')
            <br>Instagram:{{$restaurante->instagram}}
            @endif
            @if($restaurante->twitter != '')
            <br>Twitter: {{$restaurante->twitter}}
            @endif
            @if($restaurante->youTube != '')
            <br>Youtube: {{$restaurante->youTube}}
            @endif
            @if($restaurante->linkedIn != '')
            <br>LinkedIn: {{$restaurante->linkedIn}}
            @endif
        </p>
    </div>

    <button class="mt-4 btn btn-success oculto-impresion" onclick="imprimir()">Imprimir</button>

    <script>
        function imprimir() {
            window.print();
        }
    </script>
</body>

</html>
