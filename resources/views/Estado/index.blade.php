@extends('adminlte::page')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div >
                <br>
                <h1 align="left">Estados de las órdenes</h1>
                <br />
                <div align="left">
                    <button type="button" name="create_record" id="create_record" class="btn btn-primary">✚ Nuevo estado</button>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover " id="user_table">
                        <thead>
                        <tr>
                            <th width="10%">Título</th>
                            <th scope="col">Creación</th>
                            <th scope="col">Actualización</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <br />
                <br />


                <div id="formModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Agregar nuevo estado</h4>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-2" >Título </label>
                                        <div class="col-md-8">
                                            <input type="text" name="titulo" id="titulo" class="form-control" />
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

@endsection

@section('datatables')
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->
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
                    url: "{{ route('Estado.index') }}",
                },
                columns:[
                    {
                        data: 'titulo',
                        name: 'titulo'
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
                $('.modal-title').text("Agregar nuevo estado");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                if($('#action').val() == 'Add')
                {
                    $.ajax({
                        url:"{{ route('Estado.store') }}",
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
                                swal('Exito!','Agregado correctamente','success');
                                $('#sample_form')[0].reset();
                                $('#user_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            $('#formModal').modal('hide');
                        }
                    })
                }

                if($('#action').val() == "Edit")
                {
                    $.ajax({
                        url:"{{ route('Estado.update') }}",
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
                                swal('success!','Successfully Agregared','success');
                                $('#sample_form')[0].reset();

                            }
                            swal('Exito!','Actualizado correctamente','success');
                            $('#formModal').modal('hide');
                            $('#user_table').DataTable().ajax.reload();

                        }
                    });
                }
            });

            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"/Estado/"+id+"/edit",
                    dataType:"json",
                    success:function(html){
                        $('#titulo').val(html.data.titulo);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Editar estado");
                        $('#action_button').val("Editar");
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
                    url:"Estado/destroy/"+user_id,
                    beforeSend:function(){
                        $('#ok_button').text('OK');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            swal('Exito!','Eliminado Correctamente','success');
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
