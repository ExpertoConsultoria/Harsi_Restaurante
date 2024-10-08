<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaTemporal extends Model
{
    protected $table = 'comanda_temporal';

    protected $fillable =
    [
        'fila', // Array Index from Orden
        'fecha', // Fecha de Guardado
        'mesa', // Mesa Atendida
        'estado', // Estado de la Mesa [Abierta, Cerrada]
        'cajero', // Nombre del Cajero

        'guia', // Nombre del Guia
        'comision_percentage', // % de Comisión por Guia
        'mesero', // Nombre del Mesero
        'num_comensales', // Cantidad de Comensales

        'cliente', // Nombre del Cliente
        'direccion', // Dirección del Cliente

        'articulo', // Nombre del Producto
        'cantidad', // Cantidad del Producto Solicitado
        'precio_compra', // Precio del Producto
        'subtotal', // Total a pagar por los Productos
        'status', // Estado de la Comanda [Disponible, Eliminado]
        'motivo', // Motivo de Cancelación
        'comentario', // Comentario de la Comanda
    ];

    protected $primarykey = 'id';
}
