<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pedido extends Model
{
    protected $table = 'orden';

    protected $fillable =
    [
        'fecha', // Fecha de Creación
        'mesa', // Mesa Atendida
        'cajero', // Nombre del Cajero de Turno
        'turno', // Horario / Turno Laboral
        'forma_pago', // Forma de Pago

        'guia', // Nombre del Guia
        'comision_percentage', // % de Comisión por Guia
        'mesero', // Nombre del Mesero
        'num_comensales', // Cantidad de Comensales

        'cliente', // Nombre del Cliente
        'direccion', //Dirección del Cliente
        'articulo', // Resumen en texto plano de la Orden
        'comentario', // Comentarios respecto al Servicio

        'conf_total', // Total por Productos
        'descuento', // Descuento otorgado al Usuario
        'motivo_descuento', // Motivo del Descuento Dado
        'descuento_pesos', // Cantidad a Descontar al Total
        'total', // Ultimo Total - Descuento
        'comision', // Ultimo Total con Comisión Incluida
        'propina', // Propina
        'total2', // Ultimo Total + Propina
        'pago', // Pago recibido
        'cambio', // Cambio monetario
    ];

    protected $primarykey = 'id';
}
