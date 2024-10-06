@extends('adminlte::page')
    @section('content')

        <style>
            .general-reports{
                background-color: white;
                border: 1.5px rgba(179, 179, 179, 0.584) solid;
                border-radius: 0.5rem !important;
            }

            .general-reports:hover{
                background-color: #f8f8f8;
                border: 1.5px rgba(156, 156, 156, 0.584) solid;
                border-radius: 0.5rem !important;
            }
        </style>

        {{-- General Resports --}}
            @if(Auth::check() && Auth::user()->role == 'administrador')
                <div class="panel panel-primary">
                    <div class="mb-3 panel-heading">
                        <h3 class="panel-title">Reportes</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row">

                            <div class="my-1 col-md-4">
                                <a
                                    id="anual"
                                    onclick="reporteAnual()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Venta anual</span></i>
                                </a>
                            </div>

                            <div class="my-1 col-md-4">
                                <a
                                    id="mensual"
                                    onclick="reporteMensual()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Venta mensual</span></i>
                                </a>
                            </div>

                            <div class="my-1 col-md-4">
                                <a
                                    id="diario"
                                    onclick="reporteDiario()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Venta diario</span></i>
                                </a>
                            </div>

                            <div class="my-1 col-md-4">
                                <a
                                    id="listas"
                                    onclick="lista()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Listas</span></i>
                                </a>
                            </div>

                            <div class="my-1 col-md-4">
                                <a
                                    id="incidenciasDiarias"
                                    onclick="incidenciasDiarias()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Incidencias al día</span></i>
                                </a>
                            </div>

                            <div class="my-1 col-md-4">
                                <a
                                    id="incidenciasMensuales"
                                    onclick="incidenciasMensuales()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Incidencias al mes</span></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @elseif(Auth::check() && Auth::user()->role == 'cajero')
                <div class="panel panel-primary">
                    <div class="mb-3 panel-heading">
                        <h3 class="panel-title">Reportes</h3>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="my-1 col-md-4">
                                <a
                                    id="diario"
                                    onclick="reporteDiario()"
                                    class="rounded shadow-sm btn btn-lg btn-block general-reports"
                                >
                                    <i class="fas fa-caret-down"><span class="pl-2">Venta diario</span></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div id="modalAnual" class="modal fade" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalTitle">Reporte Anual</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form1" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="estado1" class="col-md-3 col-form-label">Año</label>
                                    <div class="col-md-9">
                                        <select id="estado1" class="form-control" name="estado1" required>
                                            <option value="" selected disabled>Seleccione el año</option>
                                            @foreach ($variable as $g)
                                                <option value="{{ $g }}">{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action" id="action1" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <button type="submit" name="action_button" id="action_button1" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalMensual" class="modal fade" role="dialog" aria-labelledby="modalMensualTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalMensualTitle">Reporte Mensual</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="estado" class="col-md-3 col-form-label">Año</label>
                                    <div class="col-md-9">
                                        <select id="estado" class="form-control" name="estado" required>
                                            <option value="" selected disabled>Seleccione el año</option>
                                            @foreach ($variable2 as $g)
                                                <option value="{{ $g }}">{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meses" class="col-md-3 col-form-label">Meses</label>
                                    <div class="col-md-9">
                                        <select id="meses" class="form-control" name="meses" required>
                                            <option value="" selected disabled>Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <button type="submit" name="action_button" id="action_button" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalDiario" class="modal fade" role="dialog" aria-labelledby="modalDiarioTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalDiarioTitle">Reporte Diario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form2" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="estado2" class="col-md-3 col-form-label">Mesa</label>
                                    <div class="col-md-9">
                                        <select id="estado2" class="form-control" name="estado2" required>
                                            <option value="" selected disabled>Seleccione la mesa</option>
                                            <option value="4">Todas</option>
                                            <option value="3">Restaurante</option>
                                            <option value="2">Apps</option>
                                            <option value="1">Para llevar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha" class="col-md-3 col-form-label">Fecha:</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action2" id="action2" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <button type="submit" name="action_button2" id="action_button2" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalProductosEliminados" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title3">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form3" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Año</label>
                                    <div class="col-md-8">

                                        <select id="estado3" type="text" class="form-control" name="estado3"
                                            value="{{ old('estado3') }}" required>
                                            <option id="0" selected="" disabled="" value="{{ old('estado3') }}">Seleccione el año
                                            </option>
                                            @foreach ($variable2 as $g)
                                            <option value="{{$g}}">{{$g}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                        <select id="meses3" type="text" class="form-control" name="meses3"
                                            value="{{ old('meses3') }}" required>
                                            <option id="0" selected="" disabled="" value="{{ old('meses3') }}">Seleccione el mes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action3" id="action3" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button3" id="action_button3" class="btn btn-warning"
                                        value="Add3" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalMesasCanceladas" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title5">Reporte Mensual</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result5"></span>
                            <form method="post" id="sample_form5" class="form-horizontal" enctype="multipart/form-data"
                                autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Año</label>
                                    <div class="col-md-8">

                                        <select id="estado5" type="text" class="form-control" name="estado5"
                                            value="{{ old('estado5') }}" required>
                                            <option id="0" selected="" disabled="" value="{{ old('estado5') }}">Seleccione el año
                                            </option>
                                            @foreach ($variable3 as $g)
                                            <option value="{{$g}}">{{$g}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" id="lbmeses">Meses</label>
                                    <div class="col-md-8">
                                        <select id="meses5" type="text" class="form-control" name="meses5"
                                            value="{{ old('meses5') }}" required>
                                            <option id="0" selected="" disabled="" value="{{ old('meses5') }}">Seleccione el mes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action5" id="action5" />
                                    <input type="hidden" name="hidden_id5" id="hidden_id5" />
                                    <input type="submit" name="action_button5" id="action_button5" class="btn btn-warning"
                                        value="Add5" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalListas" class="modal fade" role="dialog" aria-labelledby="modalListasTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalListasTitle">Listas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result4"></span>
                            <form method="post" id="sample_form4" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="estado4" class="col-md-3 col-form-label">Listas</label>
                                    <div class="col-md-9">
                                        <select id="estado4" class="form-control" name="estado4" required>
                                            <option value="" selected disabled>Seleccione la lista</option>
                                            <option value="1">Lista de productos</option>
                                            <option value="2">Lista de categorías</option>
                                            <option value="3">Lista de usuarios</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action4" id="action4" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <button type="submit" name="action_button4" id="action_button4" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalIncidenciasDiarias" class="modal fade" role="dialog" aria-labelledby="modalIncidenciasDiariasTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalIncidenciasDiariasTitle">Reporte Incidencias Diarias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form6" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="tipo6" class="col-md-4 col-form-label">Tipo Incidencia</label>
                                    <div class="col-md-8">
                                        <select id="tipo6" class="form-control" name="tipo6" required>
                                            <option value="" selected disabled>Seleccione el tipo de incidencia</option>
                                            <option value="1">Mesas canceladas</option>
                                            <option value="2">Productos eliminados</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="estado6" class="col-md-4 col-form-label">Mesa</label>
                                    <div class="col-md-8">
                                        <select id="estado6" class="form-control" name="estado6" required>
                                            <option value="" selected disabled>Seleccione la mesa</option>
                                            <option value="4">Todas</option>
                                            <option value="3">Restaurante</option>
                                            <option value="2">Apps</option>
                                            <option value="1">Para llevar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha6" class="col-md-4 col-form-label">Fecha:</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" id="fecha6" name="fecha6" required>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action6" id="action6" />
                                    <input type="hidden" name="hidden_id6" id="hidden_id6" />
                                    <button type="submit" name="action_button6" id="action_button6" class="btn btn-primary">Consultar<</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalIncidenciasMensuales" class="modal fade" role="dialog" aria-labelledby="modalIncidenciasMensualesTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="modalIncidenciasMensualesTitle">Reporte Mensual</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="px-5 modal-body">
                            <span id="form_result7"></span>
                            <form method="post" id="sample_form7" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <label for="tipo7" class="col-md-3 col-form-label">Tipo Incidencia</label>
                                    <div class="col-md-9">
                                        <select id="tipo7" class="form-control" name="tipo7" required>
                                            <option value="" selected disabled>Seleccione el tipo de incidencia</option>
                                            <option value="1">Mesas canceladas</option>
                                            <option value="2">Productos eliminados</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="estado7" class="col-md-3 col-form-label">Año</label>
                                    <div class="col-md-9">
                                        <select id="estado7" class="form-control" name="estado7" required>
                                            <option value="" selected disabled>Seleccione el año</option>
                                            @foreach ($variable3 as $g)
                                                <option value="{{ $g }}">{{ $g }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meses7" class="col-md-3 col-form-label">Meses</label>
                                    <div class="col-md-9">
                                        <select id="meses7" class="form-control" name="meses7" required>
                                            <option value="" selected disabled>Seleccione el mes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <input type="hidden" name="action7" id="action7" />
                                    <input type="hidden" name="hidden_id7" id="hidden_id7" />
                                    <button type="submit" name="action_button7" id="action_button7" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        {{-- Don Agave Reports --}}
            <div class="mt-4">
                <h3 class="panel-title">Otros Reportes</h3>
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center col-1">ID</th>
                            <th class="col-9">Título</th>
                            <th class="col-2"></th>
                        </tr>

                        <tr ng-repeat="report in getReportsForGroup(reportGroup.id)" class="ng-scope">
                            <td class="text-center col-1">1</td>
                            <td class="col-9">XXXX</td>
                            <td class="text-center col-3">
                                <button data-toggle="modal" data-target="#modalPorGuia" class="btn btn-primary with-icon" title="Abrir">
                                    <i class="fas fa-cloud-download-alt" aria-hidden="true"></i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalPorGuia" tabindex="-1" role="dialog" aria-labelledby="modalPorGuiaLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Informe "Ingresos por día"</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- Scripts --}}
        <script type="text/javascript">
            function reporteAnual() {
                $('.modal-title1').text("Reporte anual");
                $('#action_button1').val("Seleccionar");
                $('#action1').val("Add1");
                $('#modalAnual').modal('show');

                $.ajaxSetup({
                    beforeSend: function (xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
                });

                $('#sample_form1').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action1').val() == 'Add1') {
                        estado = $('#estado1').val();
                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado
                        };
                        $.ajax({
                            url: "/reporteAnual/" + estado,
                            type: "GET",
                            success: function (data) {
                                $('#sample_form1')[0].reset();
                                $('#modalAnual').modal('hide');
                            }
                        })
                        $(location).attr('href', '/reporteAnual/' + estado);
                    }
                });
            }

            function reporteMensual() {
                $('.modal-title').text("Reporte mensual");
                $('#lbmeses').show();
                $('#meses').show();
                $('#action_button').val("Seleccionar");
                $('#action').val("Add");
                $('#modalMensual').modal('show');

                $.ajaxSetup({
                    beforeSend: function (xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
                });

                $('#estado').on('change', function () {
                    var estado = $('#estado').val();

                    $.ajax({
                        url: "meses/" + estado,
                        type: "GET",
                        dataType: "json",
                        error: function (element) {
                            //console.log(element);
                        },
                        success: function (respuesta) {
                            $("#meses").html(
                                '<option value="" selected="true"> Seleccione el mes </option>');
                            respuesta.forEach(element => {
                                $('#meses').append('<option value=' + element.id + '> ' + element
                                    .mes + ' </option>')
                            });
                        }
                    });
                });

                $('#sample_form').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action').val() == 'Add') {
                        estado = $('#estado').val();
                        meses = $('#meses').val();

                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado,
                            "meses": meses
                        };
                        $.ajax({
                            url: "/reporteMensual/" + estado + "/" + meses,
                            type: "GET",
                            data: $('#sample_form').serialize(),
                            success: function (data) {
                                $('#sample_form')[0].reset();
                                $('#modalMensual').modal('hide');
                            }
                        })
                        $(location).attr('href', '/reporteMensual/' + estado + '/' + meses);
                    }

                });

            }

            function reporteDiario() {
                $('.modal-title2').text("Reporte diario");
                $('#action_button2').val("Seleccionar");
                $('#action2').val("Add2");
                $('#modalDiario').modal('show');


                $('#sample_form2').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action2').val() == 'Add2') {
                        estado = $('#estado2').val();
                        fecha = $('#fecha').val();
                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado
                        };
                        $.ajax({
                            url: "/reporteDiario/" + estado + '/' + fecha,
                            type: "GET",
                            success: function (data) {
                                $('#sample_form2')[0].reset();
                                $('#modalDiario').modal('hide');
                            }
                        })
                        $(location).attr('href', '/reporteDiario/' + estado + '/' + fecha);
                    }
                });
            }

            function lista() {
                $('.modal-title4').text("Listas");
                $('#action_button4').val("Seleccionar");
                $('#action4').val("Add4");
                $('#modalListas').modal('show');

                $('#sample_form4').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action4').val() == 'Add4') {
                        estado = $('#estado4').val();
                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado
                        };
                        $.ajax({
                            url: "/listas/" + estado,
                            type: "GET",
                            success: function (data) {
                                $('#sample_form4')[0].reset();
                                $('#modalListas').modal('hide');
                            }
                        })
                        $(location).attr('href', '/listas/' + estado);
                    }
                });
            }

            function incidenciasDiarias() {
                $('.modal-title6').text("Reporte de incidencias al día");
                $('#action_button6').val("Seleccionar");
                $('#action6').val("Add6");
                $('#modalIncidenciasDiarias').modal('show');

                $('#sample_form6').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action6').val() == 'Add6') {
                        estado = $('#estado6').val();
                        tipo = $('#tipo6').val();
                        fecha = $('#fecha6').val();
                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado,
                            "tipo": tipo,
                            "fecha": fecha
                        };
                        $.ajax({
                            url: "/reporteIncidenciasDiarias/" + estado + "/" + tipo + "/" + fecha,
                            type: "GET",
                            success: function (data) {
                                $('#sample_form6')[0].reset();
                                $('#modalIncidenciasDiarias').modal('hide');
                            }
                        })
                        $(location).attr('href', '/reporteIncidenciasDiarias/' + estado + '/' + tipo + "/" + fecha);
                    }
                });
            }

            function incidenciasMensuales() {
                $('.modal-title7').text("Reporte de incidencias al mes");
                $('#action_button7').val("Seleccionar");
                $('#action7').val("Add7");
                $('#modalIncidenciasMensuales').modal('show');

                $.ajaxSetup({
                    beforeSend: function (xhr, type) {
                        if (!type.crossDomain) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        }
                    },
                });

                $('#estado7').on('change', function () {

                    estado = $('#estado7').val();

                    $.ajax({
                        url: "mesesEliminados/" + estado,
                        type: "GET",
                        dataType: "json",
                        error: function (element) {
                            //console.log(element);
                        },
                        success: function (respuesta) {
                            $("#meses7").html(
                                '<option value="" selected="true"> Seleccione el mes </option>');
                            respuesta.forEach(element => {
                                $('#meses7').append('<option value=' + element.id + '> ' + element
                                    .mes + ' </option>')
                            });
                        }
                    });
                });

                $('#sample_form7').on('submit', function (event) {
                    event.preventDefault();
                    if ($('#action7').val() == 'Add7') {
                        estado = $('#estado7').val();
                        tipo = $('#tipo7').val();
                        meses = $('#meses7').val();
                        var data = {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                            "estado": estado,
                            "tipo": tipo,
                            "meses": meses
                        };
                        $.ajax({
                            url: "/reporteIncidenciasMensuales/" + estado + "/" + tipo + "/" + meses,
                            type: "GET",
                            data: $('#sample_form7').serialize(),
                            success: function (data) {
                                $('#sample_form7')[0].reset();
                                $('#modalIncidenciasMensuales').modal('hide');
                            }
                        })
                        $(location).attr('href', '/reporteIncidenciasMensuales/' + estado + '/' + tipo + '/' + meses);
                    }

                });

            }

        </script>

    @endsection

    @section('footer')
        @include('footer')
    @endsection
