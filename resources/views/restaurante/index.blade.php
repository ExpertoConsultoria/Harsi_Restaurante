@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<div class="row">
    <div class="col-xs-12">
        <div>
            <br>
            <input type="hidden" name="contador" id="contador" class="form-control" value="{{$contador}}" />
            <input type="hidden" name="validar" id="validar" class="form-control" value="{{$user['expiracion']}}" />
            <h1 align="left">INFORMACIÓN DEL RESTAURANTE</h1>

            <div class="row">
                <div class="col-md-3">
                    <button type="button" name="create_record" id="create_record" class="btn btn-primary">Agrega
                        información importante</button>
                </div>
                <div class="col-md-3">
                    <button type="button" name="descuento" id="descuento" class="btn btn-primary">Descuentos por
                        usuario</button>
                </div>
                <div class="col-md-2">
                    <button type="button" name="fechaExpiracion" id="fechaExpiracion" class="btn btn-primary">Fecha de
                        expiración</button>
                </div>
                <div class="col-md-2">
                    <button type="button" name="subcategoria" id="subcategoria" class="btn btn-primary">¿Tiene
                        subcategoría?</button>
                </div>
                <div class="col-md-1">
                    <button type="button" name="elementos" id="elementos" class="btn btn-primary">¿Reducir?</button>
                </div>
                <div class="col-md-1">
                    <a href="Manual/manual.pdf" target="_blank"><img src="/img/manual.jpg" height="50"
                            width="50"><br>Manual</a>
                </div>
                <div class="col-md-1">
                    <button type="button" name="hotel" id="hotel" class="btn btn-primary">¿Está integrado con
                        hotel?</button>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover " id="user_table">
                    <thead>
                        <tr>
                            <th width="10%">Nombre</th>
                            <th width="10%">RFC</th>
                            <th width="10%">Dirección</th>
                            <th width="10%">Telefono</th>
                            <th width="10%">Correo</th>
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
                            <h4 class="modal-title">Agrega información del restaurante</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">Nombre </label>
                                    <div class="col-md-8">
                                        <input type="text" name="nombre" id="nombre" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">RFC </label>
                                    <div class="col-md-8">
                                        <input type="text" name="rfc" id="rfc" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Dirección </label>
                                    <div class="col-md-8">
                                        <input type="text" name="direccion" id="direccion" class="form-control"
                                            required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Teléfono </label>
                                    <div class="col-md-8">
                                        <input type="tel" name="telefono" id="telefono" class="form-control"
                                            title="Ingrese un numero telefonico valido" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">E-Mail </label>
                                    <div class="col-md-8">
                                        <input type="email" name="correo" id="correo" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><i class="bi bi-facebook"></i></label>
                                    <div class="col-md-8">
                                        <input type="text" name="facebook" id="facebook" class="form-control"
                                            placeholder="Facebook" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><i class="bi bi-instagram"></i></label>
                                    <div class="col-md-8">
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                            placeholder="Instagram" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><i class="bi bi-twitter"></i></label>
                                    <div class="col-md-8">
                                        <input type="text" name="twitter" id="twitter" class="form-control"
                                            placeholder="Twitter" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><i class="bi bi-youtube"></i></label>
                                    <div class="col-md-8">
                                        <input type="text" name="youTube" id="youTube" class="form-control"
                                            placeholder="Youtube" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><i class="bi bi-linkedin"></i></label>
                                    <div class="col-md-8">
                                        <input type="text" name="linkedIn" id="linkedIn" class="form-control"
                                            placeholder="LinkedIn" />
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                        value="Add" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="formModal1" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title1">Descuento permitido por usuario</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result1"></span>
                            <form method="post" id="sample_form1" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">Desarrollador </label>
                                    <div class="col-md-8">
                                        <input type="text" name="desarrollador" id="desarrollador"
                                            placeholder="Descuento permitido %" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Administrador </label>
                                    <div class="col-md-8">
                                        <input type="text" name="administrador" id="administrador"
                                            placeholder="Descuento permitido %" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Cajero </label>
                                    <div class="col-md-8">
                                        <input type="text" name="cajero" id="cajero" class="form-control"
                                            placeholder="Descuento permitido %" required />
                                    </div>
                                </div>

                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action1" id="action1" />
                                    <input type="hidden" name="hidden_id1" id="hidden_id1" />
                                    <input type="submit" name="action_button1" id="action_button1"
                                        class="btn btn-warning" value="Add1" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="formModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title2">Fecha de expiración</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result2"></span>
                            <form method="post" id="sample_form2" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">Desarrollador </label>
                                    <div class="col-md-8">
                                        <input type="datetime-local" name="desarrollador" id="desarrollador"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Administrador </label>
                                    <div class="col-md-8">
                                        <input type="datetime-local" name="administrador" id="administrador"
                                            class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Cajero </label>
                                    <div class="col-md-8">
                                        <input type="datetime-local" name="cajero" id="cajero" class="form-control"
                                            required />
                                    </div>
                                </div>

                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action2" id="action2" />
                                    <input type="hidden" name="hidden_id2" id="hidden_id2" />
                                    <input type="submit" name="action_button2" id="action_button2"
                                        class="btn btn-warning" value="Add2" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div id="formModal3" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title3">Subcategoría</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result3"></span>
                            <form method="post" id="sample_form3" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">¿Tiene subcategoría? </label>
                                    <div class="col-md-8">
                                        <select id="subcategoria3" name="subcategoria3" class="form-control"
                                            required="">
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action3" id="action3" />
                                    <input type="hidden" name="hidden_id3" id="hidden_id3" />
                                    <input type="submit" name="action_button3" id="action_button3"
                                        class="btn btn-warning" value="Add3" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="formModal4" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title4">Reducir elementos</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result4"></span>
                            <form method="post" id="sample_form4" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">¿Reducir elementos? </label>
                                    <div class="col-md-8">
                                        <select id="reducir" name="reducir" class="form-control" required="">
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action4" id="action4" />
                                    <input type="hidden" name="hidden_id4" id="hidden_id4" />
                                    <input type="submit" name="action_button4" id="action_button4"
                                        class="btn btn-warning" value="Add4" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="formModal5" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title5">Integración con hotel</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result5"></span>
                            <form method="post" id="sample_form5" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2">¿Está ingrado con hotel? </label>
                                    <div class="col-md-8">
                                        <select id="shotel" name="shotel" class="form-control" required="">
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action5" id="action5" />
                                    <input type="hidden" name="hidden_id5" id="hidden_id5" />
                                    <input type="submit" name="action_button5" id="action_button5"
                                        class="btn btn-warning" value="Add5" />
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
            filter: false,
            paginate: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('restaurante.index') }}",
            },
            columns: [{
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'rfc',
                    name: 'rfc'

                },
                {
                    data: 'direccion',
                    name: 'direccion'
                },
                {
                    data: 'telefono',
                    name: 'telefono'
                },
                {
                    data: 'email',
                    name: 'email'
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

        $('#fechaExpiracion').click(function () {
            $('.modal-title2').text("Fecha de expiración");
            $('#action_button2').val("Guardar");
            $('#action2').val("Add2");
            $('#formModal2').modal('show');
        });

        $('#sample_form2').on('submit', function (event) {
            event.preventDefault();

            if ($('#action2').val() == "Add2") {
                $.ajax({
                    url: "{{ route('user.updateFecha') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
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
                            $('#sample_form2')[0].reset();

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal2').modal('hide');
                        //$('#user_table').DataTable().ajax.reload();

                    }
                });
            }
        });

        $('#subcategoria').click(function () {
            $('#form_result3').html('');
            $.ajax({
                url: "/editSubcategoria",
                dataType: "json",
                success: function (html) {
                    console.log(html);
                    $('#subcategoria3').val(html.data.subcategoria);
                    $('#hidden_id3').val(html.data.id);
                    $('.modal-title3').text("Subcategoria");
                    $('#action_button3').val("Modificar");
                    $('#action3').val("Add3");
                    $('#formModal3').modal('show');
                }
            })
        });

        $('#sample_form3').on('submit', function (event) {
            event.preventDefault();

            if ($('#action3').val() == "Add3") {
                $.ajax({
                    url: "{{ route('restaurante.updateSubcategoria') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        console.log(data);
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            Swal.fire(
                                'Error!',
                                'No se ha podido guardar!',
                                'error'
                            );

                        }
                        if (data.success) {
                            Swal.fire(
                                'Exito!',
                                'Agregado correctamente!',
                                'success'
                            );
                            $('#sample_form3')[0].reset();

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal3').modal('hide');
                        //$('#user_table').DataTable().ajax.reload();

                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire(
                            'Error!',
                            'No se ha podido guardar!',
                            'error'
                        );
                    }
                });
            }
        });

        $('#elementos').click(function () {
            $('#form_result4').html('');
            $.ajax({
                url: "/editReducirElementos",
                dataType: "json",
                success: function (html) {
                    console.log(html);
                    $('#reducir').val(html.data.reducir);
                    $('#hidden_id4').val(html.data.id);
                    $('.modal-title4').text("Reducir elementos");
                    $('#action_button4').val("Modificar");
                    $('#action4').val("Add4");
                    $('#formModal4').modal('show');
                }
            })
        });

        $('#sample_form4').on('submit', function (event) {
            event.preventDefault();

            if ($('#action4').val() == "Add4") {
                $.ajax({
                    url: "{{ route('restaurante.updateReducir') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        console.log(data);
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            Swal.fire(
                                'Error!',
                                'No se ha podido guardar!',
                                'error'
                            );
                        }
                        if (data.success) {
                            Swal.fire(
                                'Exito!',
                                'Agregado correctamente!',
                                'success'
                            );
                            $('#sample_form4')[0].reset();

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal4').modal('hide');
                        //$('#user_table').DataTable().ajax.reload();

                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire(
                            'Error!',
                            'No se ha podido guardar!',
                            'error'
                        );
                    }
                });
            }
        });

        $('#hotel').click(function () {
            $('#form_result5').html('');
            $.ajax({
                url: "/editIntegrarHotel",
                dataType: "json",
                success: function (html) {
                    console.log(html);
                    $('#shotel').val(html.data.hotel);
                    $('#hidden_id5').val(html.data.id);
                    $('.modal-title5').text("Integración de hotel");
                    $('#action_button5').val("Modificar");
                    $('#action5').val("Add5");
                    $('#formModal5').modal('show');
                }
            })
        });

        $('#sample_form5').on('submit', function (event) {
            event.preventDefault();

            if ($('#action5').val() == "Add5") {
                $.ajax({
                    url: "{{ route('restaurante.updateHotel') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        console.log(data);
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            Swal.fire(
                                'Error!',
                                'No se ha podido guardar!',
                                'error'
                            );
                        }
                        if (data.success) {
                            Swal.fire(
                                'Exito!',
                                'Agregado correctamente!',
                                'success'
                            );
                            $('#sample_form5')[0].reset();

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal5').modal('hide');
                        //$('#user_table').DataTable().ajax.reload();

                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire(
                            'Error!',
                            'No se ha podido guardar!',
                            'error'
                        );
                    }
                });
            }
        });

        if ($('#contador').val() > 0) {
            $("#create_record").hide();
        } else {
            $("#create_record").show();
        }

        if ($('#validar').val() != '') {
            $("#fechaExpiracion").hide();
        } else {
            $("#fechaExpiracion").show();
        }

        $('#descuento').click(function () {
            $('#form_result1').html('');
            $.ajax({
                url: "/editDescuento",
                dataType: "json",
                success: function (html) {
                    $('#desarrollador').val(html.data.descuento);
                    $('#administrador').val(html.data1.descuento);
                    $('#cajero').val(html.data2.descuento);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title1').text("Descuento permitido por usuario");
                    $('#action_button1').val("Modificar");
                    $('#action1').val("Add1");
                    $('#formModal1').modal('show');
                }
            })
        });

        $('#create_record').click(function () {
            $('.modal-title').text("Agregar información del restaurante");
            $('#action_button').val("Agregar");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#sample_form1').on('submit', function (event) {
            event.preventDefault();


            if ($('#action1').val() == "Add1") {
                $.ajax({
                    url: "{{ route('restaurante.updateDescuento') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
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
                            $('#sample_form1')[0].reset();

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal1').modal('hide');
                        $("#fechaExpiracion").hide();
                        //$('#user_table').DataTable().ajax.reload();

                    }
                });
            }
        });



        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('restaurante.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
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
                            $("#create_record").hide();


                        }
                        $('#form_result').html(html);
                        $('#formModal').modal('hide');
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                $.ajax({
                    url: "{{ route('restaurante.update') }}",
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

                        }
                        Swal.fire(
                            'Exito!',
                            'Actualizado correctamente!',
                            'success'
                        );
                        $('#formModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();

                    }
                });
            }
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/restaurante/" + id + "/edit",
                dataType: "json",
                success: function (html) {
                    console.log(html);
                    $('#nombre').val(html.data.nombre);
                    $('#rfc').val(html.data.rfc);
                    $('#direccion').val(html.data.direccion);
                    $('#telefono').val(html.data.telefono);
                    $('#correo').val(html.data.email);
                    $('#facebook').val(html.data.facebook);
                    $('#instagram').val(html.data.instagram);
                    $('#twitter').val(html.data.twitter);
                    $('#youTube').val(html.data.youTube);
                    $('#linkedIn').val(html.data.linkedIn);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Modificar información del restaurante");
                    $('#action_button').val("Modificar");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function () {
            user_id = $(this).attr('id');
            $('.modal-title').text("Eliminar información del restaurante");
            $('#confirmModal').modal('show');

        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "restaurante/destroy/" + user_id,
                beforeSend: function () {
                    $('#ok_button').text('OK');
                },
                success: function (data) {
                    $("#create_record").show();
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
        setInterval(cargarTabla, 30000);//Cada 30 segundo (30 mil milisegundos)
    });

</script>

@endsection
@section('footer')
@include('footer')
@endsection
