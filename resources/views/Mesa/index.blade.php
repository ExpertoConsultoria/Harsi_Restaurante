@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div>
                <br>
                <h1 align="left">Mesas</h1>
                <br>
                    <div align="left">
                        <button type="button" name="create_record" id="create_record" class="btn btn-primary">✚ Nueva Mesa</button>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover " id="user_table">
                            <thead>
                                <tr>
                                    <th width="10%">Título</th>
                                    <th width="10%">Estado</th>
                                    <th scope="col">Creación</th>
                                    <th scope="col">Actualización</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                <br>
                <br>
                <div id="formModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Agregar nueva mesa</h4>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-2" >Título </label>
                                        <div class="col-md-8">
                                            <input type="text" name="titulo" id="titulo" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" >Estado </label>
                                        <div class="col-md-8">
                                        <select id="estado" type="text" class="form-control" name="estado" value="{{ old('estado_id') }}" required>
                                                <option value="Abierta">Abierta</option>
                                                <option value="Cerrada">Cerrada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" >Color </label>
                                        <div class="col-md-8">
                                        <input type="color" name="color" id="color">
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

                <div id="confirmModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background: #e9605c;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2 class="modal-title">Confirmación</h2>
                            </div>
                            <div class="modal-body">
                                <h4 align="center" style="margin:0;">Estas seguro de eliminar?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#user_table').DataTable({
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('Mesa.index') }}",
                },
                columns:[
                    {
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'estado',
                        name: 'estado'

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
                    data: 'updated_at',
                    name: 'updated_at',
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

            $('#create_record').click(function(){
                $('.modal-title').text("Agregar nueva mesa");
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
                        url:"{{ route('Mesa.store') }}",
                        method:"POST",
                        data: new FormData(this),
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            var html = '';
                            if(data.errors)
                            {
                                html = '<div class="alert alert-danger">';
                                for(var count = 0; count < data.errors.length; count++)
                                {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if(data.success)
                            {
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
                            $('#sample_form')[0].reset();
                        }
                    })
                }

                if($('#action').val() == "Edit")
                {
                    $.ajax({
                        url:"{{ route('Mesa.update') }}",
                        method:"POST",
                        data:new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType:"json",
                        success:function(data) {
                            var html = '';
                            if(data.errors) {
                                html = '<div class="alert alert-danger">';
                                for(var count = 0; count < data.errors.length; count++)
                                {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if(data.success)
                            {
                                Swal.fire(
                                    'Exito!',
                                    'Agregado correctamente!',
                                    'success'
                                );
                                $('#sample_form')[0].reset();

                            }
                            Swal.fire(
                                'Exito!',
                                'Actualizado correctamente!',
                                'success'
                            );
                            $('#formModal').modal('hide');
                            $('#user_table').DataTable().ajax.reload();
                            $('#sample_form')[0].reset();

                        }
                    });
                }
            });

            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"/Mesa/"+id+"/edit",
                    dataType:"json",
                    success:function(html){
                        $('#titulo').val(html.data.titulo);
                        $('#estado').val(html.data.estado);
                        $('#color').val(html.data.color);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Modificar Mesa");
                        $('#action_button').val("Modificar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });

            var user_id;

            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"Mesa/destroy/"+user_id,
                    beforeSend:function(){
                        $('#ok_button').text('OK');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
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
            setInterval(cargarTabla, 30000);//Cada 30 segundo (30 mil milisegundos)
        });
    </script>

@endsection
@section('footer')
    @include('footer')
@endsection

