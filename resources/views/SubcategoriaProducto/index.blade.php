@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)

@section('content')

    @if ($isActivated->subcategoria == 'Si')
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <br>
                    <h1 align="left">SubCategoría de los Productos</h1>
                    <br>
                    <div align="left">
                        <button type="button" name="create_record" id="create_record" class="btn btn-primary">✚ Nueva Subcategoría</button>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover " id="subcategoria_table">
                            <thead>
                            <tr>
                                <th scope="col">Categoría</th>
                                <th scope="col">Subcategoría</th>
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
                                    <h4 class="modal-title">Agregar nueva subcategoría</h4>
                                </div>
                                <div class="modal-body">
                                    <span id="form_result"></span>
                                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                        <label class="control-label col-md-2" >Categoría </label>
                                        <div class="col-md-8">
                                        <select id="category_id"   name="category_id" class="form-control"   required="" >
                                        @foreach ($categoria as $categoria)
                                        <option  value="{{$categoria->id}}">{{$categoria->titulo}}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" >Título </label>
                                            <div class="col-md-8">
                                                <input type="text" name="titulo" id="titulo" class="form-control" required placeholder="Desayuno, Comida, Refrescos, Licores"/>
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
    @else

        <div class="row justify-content-center align-items-center g-2 mt-5">
            <div class="col-5">

                <div class="card text-center">
                  <img class="card-img-top" src="{{ asset('img/imagenes-07.png') }}" alt="Title">
                  <div class="card-body">
                    <h2 class="text-center">Lo sentimos</h2>
                    <p class="card-text">El sistema no tiene activado el atributo <b>"Subcategoria"</b> para los productos.</p>
                    <p class="text-center">Para visualizar este apartado, porfavor active las Subcategorias en la <a href="/restaurante" style="text-decoration: underline; font-weight: bold">Configuración General</a></p>
                  </div>
                </div>

            </div>
        </div>

    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#subcategoria_table').DataTable({
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
                    url: "{{ route('SubcategoriaProducto.index') }}",
                },
                columns:[
                    {
                        data: 'categoria',
                        name: 'categoria'
                    },
                    {
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            $('#create_record').click(function(){
                $('.modal-title').text("Agregar nueva categoría");
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
                        url:"{{ route('SubcategoriaProducto.store') }}",
                        method:"POST",
                        data: new FormData(this),
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            console.log(data);
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
                                $('#subcategoria_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            $('#formModal').modal('hide');
                            $('#sample_form')[0].reset();
                        },
                        error: function(error) {
                        console.log(error);

                    }
                    })
                }

                if($('#action').val() == "Edit")
                {
                    $.ajax({
                        url:"{{ route('SubcategoriaProducto.update') }}",
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
                            Swal.fire(
                                'Exito!',
                                'Actualizado correctamente!',
                                'success'
                            );
                            $('#formModal').modal('hide');
                            $('#subcategoria_table').DataTable().ajax.reload();
                            $('#sample_form')[0].reset();

                        }
                    });
                }
            });

            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url:"/SubcategoriaProducto/"+id+"/edit",
                    dataType:"json",
                    success:function(html){
                        $('#titulo').val(html.data.titulo);
                        $('#category_id').val(html.data.category_id);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Modificar producto");
                        $('#action_button').val("Modificar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });

            var subcategoria_id;

            $(document).on('click', '.delete', function(){
                subcategoria_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"SubcategoriaProducto/destroy/"+subcategoria_id,
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
                            $('#subcategoria_table').DataTable().ajax.reload();
                        }, 2000);
                    }
                })
            });

        });

        function cargarTabla(){
            $('#subcategoria_table').DataTable().ajax.reload();
        }

        $( document ).ready(function() {
            setInterval(cargarTabla, 20000);//Cada 30 segundo (30 mil milisegundos)
        });
    </script>
@endsection
@section('footer')
    @include('footer')
@endsection
