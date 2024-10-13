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

    <h2 class="my-3">Meseros del Restaurante</h1>

    <button type="button" name="create_record" id="create_record" class="my-3 text-right btn btn-success">
        ✚ Registrar Nuevo Mesero
    </button>

    <div class="container pb-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="pt-3 table-responsive col-12">
                <table class="table table-sm table-bordered table-striped table-hover" id="mesero_table">
                    <thead>
                        <tr>
                            <th class="text-center th_minus" scope="col">ID</th>
                            <th class="text-center th_minus" scope="col">Nombre Completo</th>
                            <th sclass="text-center th_minus" scope="col">Actualización</th>
                            <th sclass="text-center th_minus" scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Agregar Nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label">Nombre Completo</label>
                            <div class="col-md-8">
                                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Escribe el nombre completo" />
                            </div>
                        </div>

                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" form="sample_form" id="action_button" class="btn btn-primary" value="Agregar" />
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="text-white modal-content bg-danger">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="text-white close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center modal-body">
                    <p class="mb-0">¿Estás seguro de que deseas eliminar?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" id="delete_button" class="btn btn-light">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#mesero_table').DataTable({
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
                serverSide: true,
                ajax: {
                    url: "{{ route('meseros.index') }}",
                },
                columns: [
                    {
                        data: 'id',
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function (data, type, row) {
                            // Formatear la fecha a la zona horaria deseada
                            return new Date(data).toLocaleString('es-ES', {
                                timeZone: 'America/Mexico_City'
                            });
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
                $('.modal-title').text("Agregar nuevo Mesero");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
                $('#sample_form')[0].reset();
            });

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                if($('#action').val() == 'Add')
                {
                    $.ajax({
                        url:"{{ route('meseros.store') }}",
                        method:"POST",
                        data: new FormData(this),
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            Swal.fire(
                                'Exito!',
                                'Agregado correctamente!',
                                'success'
                            );
                            $('#sample_form')[0].reset();
                            $('#mesero_table').DataTable().ajax.reload();
                            $('#formModal').modal('hide');
                        }
                    })
                }

                if($('#action').val() == "Edit")
                {
                    $.ajax({
                        url:"{{ route('meseros.update') }}",
                        method:"POST",
                        data:new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType:"json",
                        success:function(data) {
                            Swal.fire(
                                'Exito!',
                                'Actualizado correctamente!',
                                'success'
                            );
                            $('#formModal').modal('hide');
                            $('#mesero_table').DataTable().ajax.reload();
                            $('#sample_form')[0].reset();
                        }
                    });
                }
            });

            // Load Data for Delete
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"/meseros/"+id+"/edit",
                    dataType:"json",
                    success:function(html){
                        $('#full_name').val(html.data.full_name);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Modificar Mesero");
                        $('#action_button').val("Modificar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });

            // Delete Record
            var mesero_id;
            $(document).on('click', '.delete', function () {
                mesero_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });
            $('#delete_button').click(function () {
                $.ajax({
                    url: "meseros/destroy/" + mesero_id,
                    beforeSend: function () {
                        $('#delete_button').text('Eliminar');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro ha sido Eliminado con éxito!',
                                'success'
                            );
                            $('#confirmModal').modal('hide');
                            $('#mesero_table').DataTable().ajax.reload();
                        }, 900);
                    }
                })
            });

        });


        function cargarTabla() {
            $('#mesero_table').DataTable().ajax.reload();
        }

        $(document).ready(function () {
            setInterval(cargarTabla, 30000); //Cada 30 segundo (30 mil milisegundos)
        });

    </script>

@endsection

@section('footer')
    @include('footer')
@endsection
