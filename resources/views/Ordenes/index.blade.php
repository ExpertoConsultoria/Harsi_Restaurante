@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)
@section('content')

    <style>
        .th_minus {
            font-size: 0.9rem !important
        }

        td {
            font-size: 0.95rem !important;
        }

        tr {
            background-color: #fefefe;
        }

        td, th {
            text-align: center; /* Centra horizontalmente el contenido en cada celda */
            vertical-align: middle; /* Centra verticalmente el contenido */
        }
    </style>

    <h2 class="my-3">Órdenes realizadas por Consumo</h1>

    <div class="container pb-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="pt-3 table-responsive col-12">
                <table class="table table-sm table-bordered table-striped table-hover tableUserList" id="user_table">
                    <thead>
                        <tr>
                            <th class="text-center th_minus" scope="col">Folio</th>
                            <th class="text-center th_minus" scope="col">Fecha</th>
                            <th class="text-center th_minus" scope="col">Mesa</th>
                            <th class="text-center th_minus" scope="col">Cajero</th>
                            <th class="text-center th_minus" scope="col">Método de Pago</th>
                            <th class="text-center th_minus" scope="col">Importe</th>
                            <th class="text-center th_minus" scope="col">Descuento</th>
                            <th class="text-center th_minus" scope="col">Subtotal</th>
                            <th class="text-center th_minus" scope="col">Propina</th>
                            <th class="text-center th_minus" scope="col">Total</th>
                            <th class="text-center th_minus" scope="col">Creación</th>
                            <th class="text-center th_minus" scope="col">Acciones</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #e9605c;">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmación</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Estas seguro de eliminar el consumo?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#user_table').DataTable({

                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                processing: true,
                order: [
                    [0, 'desc']
                ],
                serverSide: true,
                ajax: {
                    url: "{{ route('Ordenes.index') }}",
                },
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'mesa',
                        name: 'mesa'
                    },
                    {
                        data: 'cajero',
                        name: 'cajero'
                    },
                    {
                        data: 'forma_pago',
                        name: 'forma_pago'
                    },
                    {
                        data: 'conf_total',
                        name: 'conf_total'
                    },
                    {
                        data: 'descuento',
                        name: 'descuento'
                    },
                    {
                        data: 'total',
                        name: 'subtotal'
                    },
                    {
                        data: 'propina',
                        name: 'propina'
                    },
                    {
                        data: 'total2',
                        name: 'total'
                    },
                    {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        // Formatear la fecha a la zona horaria deseada
                        return new Date(data).toLocaleString('es-ES', { timeZone: 'America/Mexico_City' });
                    }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


            $('#create_record').click(function () {
                $('.modal-title').text("Agregar nuevo precio");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function (event) {
                event.preventDefault();
                if ($('#action').val() == 'Add') {
                    $.ajax({
                        url: "{{ route('Ordenes.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
                            var html = '';
                            if (data.errors) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                Swal.fire(
                                    'Exito!',
                                    'Agregado correctamente!',
                                    'success'
                                );
                                $('#sample_form')[0].reset();
                                $('#user_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            $('#formModal').modal('hide');
                        }
                    })
                }
            });

            var user_id;

            $(document).on('click', '.delete', function () {
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: "Ordenes/destroy/" + user_id,
                    beforeSend: function () {
                        $('#ok_button').text('OK');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro ha sido eliminado con éxito!',
                                'success'
                            );
                            $('#confirmModal').modal('hide');
                            $('#user_table').DataTable().ajax.reload();
                        }, 2000);
                    }
                })
            });

        });

        function cargarTabla(){
            $('#user_table').DataTable().ajax.reload();
        }

        $( document ).ready(function() {
            setInterval(cargarTabla, 10000);//Cada 30 segundo (30 mil milisegundos)
        });

    </script>

@endsection
@section('footer')
    @include('footer')
@endsection

@section('comando')
    <!--   Script para el calculo del total -->
    <script>
        function calcular() {
            var conftotal = document.getElementById('conftotal').value;
            var propina = document.getElementById('propina').value;
            var num = document.getElementById('desc').value;
            var sum = parseInt(conftotal) + parseInt(propina);
            var desc = (sum * num) / 100;
            document.getElementById("res").value = sum - desc;
        }

    </script>
    {{--script para las ventas--}}
    <script>
        $(document).ready(function () {
            $("#bt_add").click(function () {
                agregar();
            });
        });

        var cont = 0;
        var total = 0;
        var subtotal = [];

        //Cuando cargue el documento
        //Ocultar el botón Guardar
        $("#guardar").hide();

        function agregar() {
            //Obtener los valores de los inputs
            id_articulo = $("#pid_articulo").val();
            articulo = $("#pid_articulo option:selected").text();
            cantidad = $("#pcantidad").val();
            precio_compra = $("#pprecio_compra").val();


            // precio_venta = $("#pprecio_venta").val();

            //Validar los campos
            if (id_articulo != "" && cantidad > 0 && precio_compra != "") {

                //subtotal array inicie en el indice cero
                subtotal[cont] = (cantidad * precio_compra);
                total = total + subtotal[cont];

                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont +
                    ')">Eliminar</button></td>' +
                    '<td><input type="hidden" name="articulo_id[]" value="' + id_articulo + '">' + articulo + '</td>' +
                    '<td><input type="hidden" name="cantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                    '<td><input type="hidden" name="precio_compra[]" value="' + precio_compra + '">' + precio_compra +
                    '</td>' +
                    '<td><input type="hidden" name="subtotal[]" value="' + subtotal[cont] + '">' + subtotal[cont] +
                    '</td></tr>';
                cont++;
                limpiar();
                $("#total").html("$" + total);
                // document.getElementById('total').value = total;
                evaluar();
                $("#detalles").append(fila);
            } else {
                Swal.fire(
                    '¡Ooops!',
                    'Error al ingresar el detalle del ingreso, revise los datos del artículo!',
                    'error'
                );
            }

        }

        function limpiar() {
            $("#pcantidad").val("");
            $("#pprecio_compra").val("");
            // $("#pprecio_venta").val("");
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            total = total - subtotal[index];
            $("#total").html("$" + total);
            $("#fila" + index).remove();
            evaluar();
        }

    </script>
    <!--  Script para Especialidades  -->
    <script>
        $(document).ready(function () {
            $("#agrega").click(function () {
                agrega();
            });
        });

        var cont = 0;
        var total = 0;
        var subtotal = [];

        function agrega() {

            especialidad = $("#pespecial").val();
            esprecio = $("#pesprecio").val();
            espcant = $("#pespcant").val();

            if (especialidad != "" && espcant > 0 && esprecio != "") {

                subtotal[cont] = (espcant * esprecio);
                total = total + subtotal[cont];

                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont +
                    ')">Eliminar</button></td>' +
                    '<td><input type="hidden" name="pespecial[]" value="' + especialidad + '">' + especialidad + '</td>' +
                    '<td><input type="hidden" name="pesprecio[]" value="' + espcant + '">' + espcant + '</td>' +
                    '<td><input type="hidden" name="pespcant[]" value="' + esprecio + '">' + esprecio + '</td>' +
                    '<td><input type="hidden" name="subtotales[]" value="' + subtotal[cont] + '">' + subtotal[cont] +
                    '</td></tr>';
                cont++;
                limpiar();
                $("#total").html("$" + total);
                evaluar();
                $("#detalles").append(fila);
            } else {
                Swal.fire(
                    '¡Ooops!',
                    'Error al ingresar el detalle del ingreso extra, Complete los datos!',
                    'error'
                );
            }

        }

        function eliminar(index) {
            total = total - subtotal[index];
            $("#total").html("$" + total);
            $("#fila" + index).remove();
            evaluar();
        }

    </script>
    {{--script para el registro a la db--}}


    {{--Selescts Dinamicos--}}
    <script>
        $(function () {
            $('#select-categoria').on('change', onSelectChange);
            $('#pid_articulo').on('change', onSelectPrice);
        });

        function onSelectChange() {
            var categoria_id = $(this).val();
            if (!categoria_id)
                $('#pid_articulo').html('<option value="">Seleccionar</option>');

            $.get('api/Proyecto/' + categoria_id + '/titulo', function (data) {
                var html_select = '<option value="">Seleccionar</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].id + '" >' + data[i].titulo + '</option>';

                $('#pid_articulo').html(html_select);

            });
        }

        function onSelectPrice() {
            var product_id = $(this).val();
            if (!product_id)
                $('#pprecio_compra').html('<option value="">Seleccionar</option>');

            $.get('api/Precio/' + product_id + '/precio', function (data) {
                var html_select = '<option value="">Seleccionar</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value="' + data[i].precio + '" >' + data[i].precio + '</option>';

                $('#pprecio_compra').html(html_select);

            });
        }

    </script>
@endsection
