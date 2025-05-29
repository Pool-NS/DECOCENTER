<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\InventoryLog;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Solo usuarios autenticados pueden acceder
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        return view('productos.create');
    }

    // Almacenar producto en base de datos
    public function store(Request $request)
    {
        // Convertir nombre a minúsculas para evitar duplicados por mayúsculas/minúsculas
        $nameLower = strtolower($request->name);
        $request->merge(['name' => $nameLower]);

        // Validación con regla unique para evitar duplicados en columna 'name'
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\-]+$/u', 'unique:productos,name'],
            'category' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'name.regex' => 'El nombre solo debe contener letras y espacios.',
            'name.unique' => 'Ya existe un producto con ese nombre.',
            'category.regex' => 'La categoría solo debe contener letras y espacios.',
            'price.min' => 'El precio debe ser mayor que cero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'category' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'name.regex' => 'El nombre solo debe contener letras y espacios.',
            'category.regex' => 'La categoría solo debe contener letras y espacios.',
            'price.min' => 'El precio debe ser mayor que cero.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update($validated);

        InventoryLog::create([
            'product_id' => $producto->id,
            'user_id' => auth()->id(),
            'type' => 'entrada',
            'quantity' => 0,
            'description' => 'Se actualizó la información del producto.',
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $cantidadEliminada = $producto->stock;

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
