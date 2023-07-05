@extends('adminlte::page')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div >
            <h1 align="center">Detalle de la órden</h1>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="user_table">
                    <thead>
                        <tr>
                            <th width="col">Folio de Órdene</th>
                            <th width="col">Producto</th>
                            <th width="col">Cantidad</th>
                            <th width="col">Precio de compra</th>
                            <th width="col">Subtotal</th>
                            <th scope="col">Creación</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
@endsection
@section('footer')
    @include('footer')
@endsection
@section('datatables')
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
                url: "{{ route('DetalleOrden.index') }}",
            },
            columns:[
                {
                    data: 'orden_id',
                },
                {
                    data: 'title',

                },
                {
                    data: 'cantidad',
                    name: 'cantidad'
                },
                {
                    data: 'precio_compra',
                    name: 'precio_compra'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
        $('#create_record').click(function(){
            $('.modal-title').text("Agregar nuevo precio");
            $('#action_button').val("Agregar");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                $.ajax({
                    url:"{{ route('DetalleOrden.store') }}",
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
                    url:"{{ route('Ordenes.update') }}",
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
                            html = '<div class="alert alert-success">' + data.success + '</div>';
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
                url:"/Ordenes/"+id+"/edit",
                dataType:"json",
                success:function(html){
                    $('#fecha').val(html.data.fecha);
                    $('#mesa').val(html.data.mesa);
                    $('#cajero').val(html.data.cajero);
                    $('#forma_pago').val(html.data.forma_pago);
                    $('#propina').val(html.data.propina);
                    $('#res').val(html.data.res);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Editar precio");
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
                url:"DetalleOrden/destroy/"+user_id,
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
