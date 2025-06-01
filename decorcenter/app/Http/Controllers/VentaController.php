<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\InventoryLog;


class VentaController extends Controller
{
    public function formulario($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.vender', compact('producto'));
    }

    public function procesar(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'cantidad' => 'required|integer|min:1|max:' . $producto->stock,
        ]);

        $cantidad = $request->input('cantidad');
        $producto->stock -= $cantidad;
        $producto->save();

        // Guardar la venta
        Venta::create([
            'producto_id' => $producto->id,
            'cantidad' => $cantidad,
            'precio_unitario' => $producto->price,
        ]);

        // Registrar en InventoryLog como salida
        InventoryLog::create([
            'product_id' => $producto->id,
            'user_id' => auth()->id(), // Puedes dejar null si es venta pública
            'type' => 'salida',
            'quantity' => $cantidad,
            'description' => 'Salida de inventario por venta.',
        ]);

        $total = $producto->price * $cantidad;

        return redirect()->route('productos.index')->with('success', "Venta realizada. Total: S/. {$total}");
    }
}