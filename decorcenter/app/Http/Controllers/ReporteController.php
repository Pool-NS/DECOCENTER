<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ReporteController extends Controller
{
    public function ventasPorMes()
    {
        // Total de ventas por mes
        $ventasPorMes = DB::table('ventas')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes"),
                DB::raw("SUM(cantidad * precio_unitario) as total_ventas")
            )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // Total de ventas por producto y mes
        $ventasPorProducto = DB::table('ventas')
            ->join('productos', 'ventas.producto_id', '=', 'productos.id')
            ->select(
                'productos.name as producto',
                DB::raw("DATE_FORMAT(ventas.created_at, '%Y-%m') as mes"),
                DB::raw("SUM(ventas.cantidad * ventas.precio_unitario) as total_ventas")
            )
            ->groupBy('producto', 'mes')
            ->orderBy('mes', 'asc')
            ->orderBy('producto', 'asc')
            ->get();

        return view('reportes.ventas_por_mes', compact('ventasPorMes', 'ventasPorProducto'));
    }

    public function productosMasVendidos()
    {
        $productosMasVendidos = DB::table('ventas')
            ->select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->limit(10)  // opcional, por ejemplo los top 10
            ->get();

        // Para mostrar el nombre del producto, hacemos join con la tabla productos
        $productosMasVendidos = DB::table('ventas')
            ->join('productos', 'ventas.producto_id', '=', 'productos.id')
            ->select('productos.name', DB::raw('SUM(ventas.cantidad) as total_vendido'))
            ->groupBy('productos.name')
            ->orderByDesc('total_vendido')
            ->limit(10)
            ->get();

        return view('reportes.productos_mas_vendidos', compact('productosMasVendidos'));
    }

    public function variacionStock()
    {
        // Obtenemos todos los registros de inventario con relación al producto
        $logs = DB::table('inventory_logs')
            ->join('productos', 'inventory_logs.product_id', '=', 'productos.id')
            ->select(
                'productos.name as producto',
                DB::raw('DATE(inventory_logs.created_at) as fecha'),
                DB::raw('SUM(CASE WHEN inventory_logs.type = "entrada" THEN inventory_logs.quantity ELSE 0 END) as entradas'),
                DB::raw('SUM(CASE WHEN inventory_logs.type = "salida" THEN inventory_logs.quantity ELSE 0 END) as salidas')
            )
            ->groupBy('producto', 'fecha')
            ->orderBy('fecha', 'asc')
            ->orderBy('producto', 'asc')
            ->get();

        // También necesitamos el stock actual por producto
        $stocksActuales = \App\Models\Producto::pluck('stock', 'name'); // ['nombre' => stock]

        return view('reportes.variacion_stock', compact('logs', 'stocksActuales'));
    }

    public function usuariosRegistrados()
    {
        $usuarios = \App\Models\User::with('roles')->select('id', 'name', 'email', 'created_at')->orderBy('created_at', 'desc')->get();
        $roles = Role::all(); // Obtén todos los roles

        return view('reportes.usuarios_registrados', compact('usuarios', 'roles'));
    }

}
