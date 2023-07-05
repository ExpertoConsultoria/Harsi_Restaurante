@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)
@section('content')
    <h1 align="left">Horarios para cajeros</h1>

    <div align="left">
        <button type="button" name="create_record" id="create_record" class="btn btn-primary">✚ Nuevo turno</button>
        <a type="button" class="oculto-impresion btn btn-warning" href="{{ route('usuarios.index') }}">Regresar</a>
    </div>

    <!-- Modal -->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar nuevo turno</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2" >Turno </label>
                            <div class="col-md-8">
                            <input type="text" name="turno" id="turno" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" >Hora Inicio </label>
                            <div class="col-md-8">
                                <input type="time" value="<?php echo date("H");?>" name="fecha_ini" id="fecha_ini" class="form-control" required />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2" >Hora Final </label>
                            <div class="col-md-8">
                                <input type="time" value="<?php echo date("H");?>" name="fecha_fin" id="fecha_fin" class="form-control" required />
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

    <div class="row">
        <div class="col-md-7">
            <div class="box box-primary" style="margin-top:10px;">
                    <div class="box-header with-border">
                    <h3 class="box-title">Tabla de turnos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <div class="box-body">
                    <br>
                    <div class="chart">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover " id="horario_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Turno</th>
                                        <th scope="col">Fecha Inicio</th>
                                        <th scope="col">Fecha Final</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                </table>

                            </div>
                    </div>
                    </div>
            </div>
        </div>
        <div class="col-md-5">

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#horario_table').DataTable({
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
                    url: "{{ route('Turno.index') }}",
                },
                columns:[
                    {
                        data: 'turno',
                        name: 'turno'
                    },
                    {
                        data: 'fecha_ini',
                        name: 'fecha_ini'
                    },
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


            $('#create_record').click(function(){
                $('.modal-title').text("Agregar nuevo turno");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                if($('#action').val() == 'Add')
                {
                    $.ajax({
                        url:"{{ route('Turno.store') }}",
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

                                $('#sample_form')[0].reset();

                                location.reload();
                            }
                            $('#form_result').html(html);
                            $('#formModal').modal('hide');
                        }
                    })
                }
                if($('#action').val() == "Edit")
                {
                    $.ajax({
                        url:"{{ route('Turno.update') }}",
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
                                $('#sample_form')[0].reset();
                                location.reload();
                            }
                            $('#formModal').modal('hide');
                            location.reload();
                        }
                    });
                }
            });

            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"/editTurno/"+id,
                    dataType:"json",
                    success:function(html){
                        $('#turno').val(html.data.turno);
                        $('#fecha_ini').val(html.data.fecha_ini);
                        $('#fecha_fin').val(html.data.fecha_fin);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Modificar Turno");
                        $('#action_button').val("Modificar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });
            var id;
            $(document).on('click', '.delete', function(){
                id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function(){
                $.ajax({
                    url:"Turno/destroy/"+id,
                    beforeSend:function(){
                        $('#ok_button').text('OK');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                })
            });
        });


        function cargarTabla(){
            $('#horario_table').DataTable().ajax.reload();
        }

        $( document ).ready(function() {
            setInterval(cargarTabla, 30000);//Cada 30 segundo (30 mil milisegundos)
        });
    </script>
@endsection
@section('footer')
    @include('footer')
@endsection

