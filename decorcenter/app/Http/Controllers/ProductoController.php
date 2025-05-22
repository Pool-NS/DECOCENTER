<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Aseguramos que solo los usuarios logueados puedan acceder
    }

    // Muestra la vista de crear producto
    public function create()
    {
        return view('productos.create');
    }

    // Almacena el producto en la base de datos
    public function store(Request $request)
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

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Muestra la lista de productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // Muestra el formulario para editar un producto
    public function edit($id)
    {
        // Busca el producto por su ID
        $producto = Producto::findOrFail($id);

        // Retorna la vista de edición con el producto
        return view('productos.edit', compact('producto'));
    }

    // Actualiza un producto en la base de datos
    public function update(Request $request, $id)
    {
        // Valida los datos enviados por el formulario
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

        // Encuentra el producto por ID
        $producto = Producto::findOrFail($id);

        // Actualiza los datos del producto
        $producto->update($validated);

        // Redirige a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Elimina un producto
    public function destroy($id)
    {
        // Encuentra el producto por ID
        $producto = Producto::findOrFail($id);

        // Elimina el producto
        $producto->delete();

        // Redirige a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
