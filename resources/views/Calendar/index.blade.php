@extends('adminlte::page')
@section('plugins.Datatables',true)
@section('plugins.Sweetalert2',true)

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <h1 class="text-start">Gestión de Reservaciones</h1>

    <div class="mt-4">
        <button type="button" name="create_record" id="create_record" class="btn btn-primary">✚ Nuevo evento</button>
    </div>

    <!-- Modal Form -->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Reservación</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Nombre de la Reservación</label>
                            <div class="col-md-8">
                                <input type="text" name="titulo" id="titulo" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Personas </label>
                            <div class="col-md-8">
                                <input type="text" name="personas" id="personas" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Fecha</label>
                            <div class="col-md-8">
                                <input type="date" value="<?php echo date("Y-m-d");?>" name="fecha_ini" id="fecha_ini"
                                    class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="mesas">Mesas</label>
                            <select id="mesas" name="mesas[]" class="form-control selectpicker" title="-- Asignar Mesas --" multiple required>
                                <option value="Todas las Mesas">Todas las Mesas</option>
                                    @foreach($mesas as $mesa)
                                        <option value="{{ $mesa->titulo }}">{{ $mesa->titulo }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Color </label>
                            <div class="col-md-8">
                                <input type="color" name="color" id="color" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Detalles </label>
                            <div class="col-md-8">
                                <input type="text" name="detalles" id="detalles" class="form-control" required />
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

    <!-- Modal Delete -->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #e9605c;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmación</h2>
                </div>
                <div class="modal-body">
                    <h4 class="text-center" style="margin:0;">Estas seguro de eliminar?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Structure -->

    <div class="row mt-4">
        <div class="col-md-5">
                <div class="box box-primary">
                    <h3 class="mb-0">Tabla de Registros</h3>
                    <div class="box-body">
                        <br>
                        <div class="chart" id="chart">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover " id="user_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Título</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Mesas</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-7">

                <div class="box box-primary">
                    <h3 class="mb-0">Calendario de Reservaciones</h3>
                    <div class="box-body">
                        <div class="chart">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    {{-- Importaciones --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src="{{ asset('vendor/fullcalendar/locales/es.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    {{-- Funciones Calendario --}}
    <script>

        window.onbeforeunload = function () {
            localStorage.removeItem("Tables");
        };

        document.addEventListener('DOMContentLoaded', function (event) {
            event.preventDefault();

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                locale: 'es',
                editable: true,
                navLinks: false,
                allDaySlot: true,
                initialView: 'dayGridMonth',

                titleFormat: {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                },
                headerToolbar: {
                    start: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,listWeek'
                },

                navLinkDayClick: function (date, jsEvent) {

                    $('#formModal').modal('show');
                    $('#fecha_ini').val(moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#fecha_fin').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
                },
                buttonText: {
                    today: 'Hoy',
                },

                events: [

                    @foreach($calendar as $calendar) {
                        id: "{{ $calendar->id }}",
                        title: "{{ $calendar->titulo }}",
                        start: "{{ $calendar->fecha }}",
                        end: "{{ $calendar->fecha }}",
                        borderColor: '{{ $calendar->color }}',
                        backgroundColor: '{{ $calendar->color }}2f',
                        textColor: '#000000',
                        classNames: ['Detalles del Evento', '{{ $calendar->personas }}',
                            '{{ $calendar->detalles }}',
                        ],
                    },
                    @endforeach

                ],

                eventClick: function (info) {

                    $.get('api/reservations/'+info.event.id, function (data) {
                        data = JSON.stringify(data);
                        localStorage.setItem("Tables", data);
                    });

                    setTimeout(function(){
                        var mesasReservadas = localStorage.getItem("Tables");
                        mesasReservadas = JSON.parse(mesasReservadas);
                        mesasReservadas = mesasReservadas.mesas;

                        mesas = '';

                        for (let index = 0; index < mesasReservadas.length; index++) {
                            mesas += mesasReservadas[index]+', ';

                        }
                        console.log(mesas);

                        var fecha = new Date(info.event.start).toLocaleDateString('en-us', {
                            weekday: "long",
                            year: "numeric",
                            month: "short",
                            day: "numeric"
                        })

                        Swal.fire({
                            title: '<hr style="margin-top : -2rem;">' + info.event.classNames[0],
                            imageUrl: '{{ asset('img/imagenes-07.png') }}',
                            imageWidth: 200,
                            imageHeight: 70,
                            imageAlt: 'Harsi Logo',
                            html: `

                                <div class="container">
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col-10">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 90px;" class="input-group-text">{{ __('Evento No.') }}</span>
                                                </div>
                                                <input readonly="readonly" class="form-control" value="${info.event.id}">
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 90px;" class="input-group-text">{{ __('Nombre') }}</span>
                                                </div>
                                                <input readonly="readonly" class="form-control" value="${info.event.title}">
                                            </div>

                                            <hr>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 90px;" class="input-group-text">{{ __('Fecha') }}</span>
                                                </div>
                                                <input readonly="readonly" class="form-control" value="${fecha}">
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 90px;" class="input-group-text">{{ __('Mesas') }}</span>
                                                </div>
                                                <input readonly="readonly" class="form-control" value="${mesas}">
                                            </div>

                                            <hr>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 120px;" class="input-group-text">{{ __('No. Personas') }}</span>
                                                </div>

                                                <input readonly="readonly" class="form-control" value="${info.event.classNames[1]}">
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span style="width : 120px;" class="input-group-text">{{ __('Detalles') }}</span>
                                                </div>
                                                <input readonly="readonly" class="form-control" value="${info.event.classNames[2]}">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                `,
                            // focusConfirm: false,
                            showCloseButton: true,
                            showConfirmButton: false,
                        });
                    }, 500);

                }

            });

            calendar.render();

            setInterval(loadData, 4000); //Cada 7 segundo (7 mil milisegundos)

            function loadData(){
                var reload = localStorage.getItem("ReLoad");
                // console.log(reload);
                if(reload != null){
                    calendar.removeAllEvents();
                    var ev = localStorage.getItem("EventData");
                    // ev = JSON.parse(JSON.stringify(ev));
                    ev = JSON.parse(ev);
                    // console.log(ev);
                    calendar.addEventSource( ev );
                    calendar.refetchEvents();
                    // console.log('Ciclando');
                }
            }

            // On window unload
            window.onbeforeunload = function () {
                localStorage.removeItem("EventData");
                localStorage.removeItem("ReLoad");
            };

            // On window unload
            window.onload = function () {
                localStorage.setItem("EventData", "");
                localStorage.setItem("ReLoad", null);
                getEvents();
            };

            function getEvents() {

                var events = localStorage.getItem("EventData");

                $.get('api/calendar/events', function (data) {
                    if (events != '') {
                        data = JSON.stringify(data);

                        if (data != events) {
                            // data = JSON.parse(data);
                            localStorage.setItem("EventData", data);
                            localStorage.setItem("ReLoad", "Si");
                        } else {
                            localStorage.setItem("ReLoad", null);
                        }

                    } else {
                        data = JSON.stringify(data);
                        localStorage.setItem("EventData", data);
                    }

                });
            }

            setInterval(getEvents, 3500); //Cada 30 segundo (30 mil milisegundos)
        });


        $(function () {
            $('#type').on('change', onWrite);
            $('#valueTypex').on('change', onSelectFilter);
        });

        function onWrite() {
            var typerooms_id = $(this).val();
            if (!typerooms_id)
                $('#valueTypex').html('<option value="" selected disabled>-- -- --</option>');

            $.get('api/Room/' + typerooms_id + '/typeroom', function (data) {
                console.log(data);
                var html_select = '<option value="" selected disabled>- Seleccionar -</option>';
                for (var i = 0; i < data.length; ++i)
                    html_select += '<option value=" ' + data[i].id + '" >' + data[i].room_number + '</option>';
                $('#valueTypex').html(html_select);
            });
        }

        function onSelectFilter() {
            var id = $(this).val();
            // $.get('api/client/'+ id + '/byId', function(data) {
            //     // console.log(data[0].id);
            //     // console.log(data[0].client_name);
            //     $('#re_cliente').val(data[0].client_name);
            //     $('#cliente_id').val(data[0].id);
            // });
        }

    </script>

    {{-- Funcioens Tabla --}}
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
                dom: 'fp',
                serverSide: true,
                ajax: {
                    url: "{{ route('Calendar.index') }}",
                },
                columns: [{
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'mesas',
                        name: 'mesas'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


            $('#create_record').click(function () {
                $('.modal-title').text("Agregar Reservación");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
                $('#sample_form')[0].reset();
            });

            $('#sample_form').on('submit', function (event) {
                event.preventDefault();
                if ($('#action').val() == 'Add') {
                    $.ajax({
                        url: "{{ route('Calendar.store') }}",
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
                                //                                swal('Exito!','Agregado correctamente','success');
                                $('#sample_form')[0].reset();
                                //                                $('#user_table').DataTable().ajax.reload();
                                location.reload();
                            }
                            $('#form_result').html(html);
                            $('#formModal').modal('hide');
                            $('#sample_form')[0].reset();
                        }
                    })
                }
                if ($('#action').val() == "Edit") {
                    $.ajax({
                        url: "{{ route('Calendar.update') }}",
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
                                $('#sample_form')[0].reset();
                                location.reload();
                            }
                            $('#formModal').modal('hide');
                            $('#sample_form')[0].reset();
                            location.reload();
                        }
                    });
                }
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url: "/Calendar/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        $('#titulo').val(html.data.titulo);
                        $('#personas').val(html.data.personas);
                        $('#fecha_ini').val(html.data.fecha_ini);
                        $('#mesas').val(html.data.mesas);
                        $('#color').val(html.data.color);
                        $('#detalles').val(html.data.detalles);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Modificar Reservación");
                        $('#action_button').val("Modificar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });
            var user_id;
            $(document).on('click', '.delete', function () {
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: "Calendar/destroy/" + user_id,
                    beforeSend: function () {
                        $('#ok_button').text('OK');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                })
            });
        });

        function cargarTabla(){
            $('#user_table').DataTable().ajax.reload();
        }

        $( document ).ready(function() {
            setInterval(cargarTabla, 9000);//Cada 30 segundo (30 mil milisegundos)
        });

    </script>

@endsection

@section('footer')
    @include('footer')
@endsection
