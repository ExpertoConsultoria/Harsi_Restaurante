@extends('layouts.app')

@section('content')

    <div class="py-3">
        <div id="carouselMesas" class="pt-4 carousel slide" data-ride="carousel" data-interval="false" style="height: 100vh;">
            {{-- Contenido del Carrusel --}}
            <div class="carousel-inner " id="carousel_tables">
            </div>

            <!-- Controles del Carousel -->
            <a class="pr-5 carousel-control-prev" href="#carouselMesas" role="button" data-slide="prev">
                <span
                    class="px-3 py-1 carousel-control-prev-icon btn-success"
                    aria-hidden="true"
                    style="opacity: 0.25;"
                    onmouseover="this.style.opacity='1';"
                    onmouseout="this.style.opacity='0.25';"
                ></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="pl-5 carousel-control-next" href="#carouselMesas" role="button" data-slide="next">
                <span
                    class="px-3 py-1 carousel-control-next-icon btn-success"
                    aria-hidden="true"
                    style="opacity: 0.25;"
                    onmouseover="this.style.opacity='1';"
                    onmouseout="this.style.opacity='0.25';"
                ></span>
                <span class="sr-only">Siguiente</span>
            </a>

        </div>
    </div>

@endsection

@section('funciones')
    {{-- Importaciones --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- Get By Apis --}}
    <script type="text/javascript">
        // On window load
        window.onload = function () {
            localStorage.setItem("Tables", '');
            getTables();
        }

        // On window unload
        window.onbeforeunload = function () {
            localStorage.removeItem("Tables");
        };

        // Renderizar Tabla (Mesas)
        function generateFoodDishesList(table_data) {
            return `
                <ul class="px-2 pt-3 pb-1 list-group list-group-flush">
                    ${table_data.table_status !== 'Disponible' ? (
                        table_data.food_dishes.length > 0 ?
                            table_data.food_dishes.map(dish => `
                                <li class="list-group-item" style="${dish.ready_to_serve ? 'background-color:#F0F0F0' : ''}">

                                    {{-- Producto y Cantidad --}}
                                    <div class="pb-0 mb-0 mb-2 d-flex justify-content-between align-items-center">
                                        <div style="width: 90%;">
                                            <u style="font-size: 1.1rem !important;">
                                            ${dish.product_name.length > 25 ? `${dish.product_name.slice(0, 25)}...` : dish.product_name}
                                            </u>
                                        </div>

                                        <div style="width: 10%;">
                                            <span class="badge badge-pill badge-dark" style="font-size: 0.95rem !important;">
                                            ${dish.product_quantity}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Especificaciones del producto y Botón --}}
                                    <div class="pb-0 mb-0 mb-2 d-flex justify-content-between align-items-center">
                                        <div style="${dish.ready_to_serve ? 'width: 100%;' : 'width: 80%;'}" class="pb-0 mb-0">
                                            <p style="${dish.ready_to_serve ? '' : 'padding-right: 1rem;'}" class="pb-0 mb-0">${dish.product_specifications}</p>
                                        </div>

                                        ${dish.ready_to_serve
                                            ? ''
                                            : `
                                                <div style="width: 20%;" class="text-right class="pb-0 mb-0">
                                                    <button type="button" onclick="updateProductStatus(${dish.command_id})" class="btn btn-primary">Listo</button>
                                                </div>
                                            `
                                        }

                                    </div>


                                </li>
                            `).join('')
                            : '<li class="text-center list-group-item">No hay platillos</li>'
                    ) : ''}
                </ul>`;
        }

        function renderTables(data) {
            let carousel_items = '';
            let itemsPerSlide = 3; // Número de mesas por vista

            // Agrupamos las mesas en grupos de 3
            for (let i = 0; i < data.length; i += itemsPerSlide) {
                const group = data.slice(i, i + itemsPerSlide); // Obtenemos un grupo de mesas
                const isActive = i === 0 ? 'active' : ''; // Marca el primer item como activo

                carousel_items += `
                    <div class="carousel-item ${isActive}">
                        <div class="d-flex justify-content-around">
                `;

                group.forEach(table_data => {
                    carousel_items += `
                        <div class="p-2 card"
                            style="width: 30%; height: fit-content; border-radius: 1rem;
                                    ${table_data.table_status === 'Disponible'
                                        ? 'background-color:#f8f8f8; max-height: 8rem;'
                                        : 'border: 1.8px solid #006b8e'
                                    }
                            "
                        >
                            <div class="mb-0 card-body" style="flex:none;">
                                <div class="row">
                                    {{-- Nombre Mesa --}}
                                    <div class="mb-1 col-6">
                                        <h4>${table_data.table_name}</h4>
                                    </div>

                                    {{-- Pill Status --}}
                                    <div class="text-right col-6" style="position: relative;">
                                        <div
                                            class="p-1 badge badge-pill ${table_data.table_status === 'Disponible' ? 'badge-secondary' : 'badge-success'}"
                                            style="
                                                width: 1.3rem;
                                                height: 1.3rem;
                                                position: absolute;
                                                top: -0.5rem;
                                                right: 0.5rem;
                                            "
                                        >
                                            &nbsp;
                                        </div>
                                    </div>

                                    {{-- Mesero --}}
                                    <div class="col-6">
                                        <p class="card-text">
                                            <strong>Mesero:</strong> ${table_data.waiter_name}
                                        </p>
                                    </div>

                                </div>
                            </div>

                            ${generateFoodDishesList(table_data)}
                        </div>
                    `;
                });

                carousel_items += `
                        </div>
                    </div>
                `;
            }

            $('#carousel_tables').html(carousel_items);
            localStorage.setItem("Tables", JSON.stringify(data));
        }

        function getTables() {
            let tables = localStorage.getItem("Tables");

            $.get('/home', function (data) {
                const dataString = JSON.stringify(data);

                // Si hay tablas guardadas en localStorage
                if (tables && tables !== dataString) {
                    renderTables(data);
                }
                // Si no hay tablas en localStorage
                else if (!tables) {
                    renderTables(data);
                }
            });
        }

        $(document).ready(function () {
            setInterval(getTables, 8000); // Cada 20 segundos (20 mil milisegundos)
        });

    </script>

    {{-- Product Control Status --}}
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function updateProductStatus(command_id) {

            Swal.fire({
                title: 'Está seguro que desea pagar la mesa?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sí!'
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "/updateFoodStatus", // Guardamos todo el Pedido
                        type: "POST",
                        data: {
                            "command_id": command_id,
                        },
                        success: function (data) {
                            Swal.fire({
                                title: 'Actualiazdo!',
                                text: 'Estado del Platillo Modificado.',
                                icon: 'success',
                                confirmButtonText: 'Entendido',
                            }).then(() => {
                                getTables();
                            });
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'No se ha podido guardar!',
                            })
                        }
                    });
                }
            });

        }
    </script>

@endsection
