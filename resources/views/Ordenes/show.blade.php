<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">

    <title>Ticket de Venta | {{ $orden->id }}</title>

    {{-- Boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- Jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

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

        /* Nav - Tabs */
        .nav-tabs {
            color: #0d6889;
        }

        .nav-item:hover {
            filter: brightness(0.95); /* Disminuye el brillo para oscurecer */
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #0d6889;
            border-color: #dee2e6 #dee2e6 #dee2e6 #dee2e6;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link {
            border: 1px solid #dee2e6;
            color: #0d6889;
            background-color: #fff;
            border-radius: 1px;
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

    <div class="d-flex justify-content-center">
        <ul class="mb-4 nav nav-tabs oculto-impresion" id="myTab" role="tablist">
            <li class="mx-2 nav-item">
                <a class="nav-link active" id="external-tab" href="#external" role="tab" aria-controls="external" aria-selected="true">
                    Ticket Externo
                </a>
            </li>
            <li class="mx-2 nav-item">
                <a class="nav-link" id="internal-tab" href="#internal" role="tab" aria-controls="internal" aria-selected="false">
                    Ticket Interno
                </a>
            </li>
        </ul>
    </div>


    <div class="tab-content" id="ticketTabs">

        {{-- External Ticket (Con Guia) --}}
        <div class="tab-pane fade show active" id="external" role="tabpanel" aria-labelledby="external-tab">
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
        </div>

        {{-- Internal Ticket  (Sin Guia)  --}}
        <div class="tab-pane fade" id="internal" role="tabpanel" aria-labelledby="internal-tab">
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
        </div>

    </div>

    <button class="mt-4 btn btn-success oculto-impresion" onclick="imprimir()">Imprimir</button>

    <script>
        function imprimir() {
            window.print();
        }

        $(document).ready(function() {

            $("#external").tab('show');

            $('.nav-tabs a').on('click', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado
                $(this).tab('show'); // Mostrar la pestaña correspondiente
            });
        });
    </script>
</body>

</html>
