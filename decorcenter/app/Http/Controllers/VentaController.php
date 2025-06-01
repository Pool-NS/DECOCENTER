<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;

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

        $total = $producto->price * $cantidad;

        return redirect()->route('productos.index')->with('success', "Venta realizada. Total: S/. {$total}");
    }
}