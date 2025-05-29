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
            'stock' => ['required', 'integer', 'min:0'], 
            'description' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'name.regex' => 'El nombre solo debe contener letras y espacios.',
            'category.regex' => 'La categoría solo debe contener letras y espacios.',
            'price.min' => 'El precio debe ser mayor que cero.',
            'stock.min' => 'El stock no puede ser negativo.', 
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        ]);
        

        $producto = new Producto();

        $producto->name = $request->name;
        $producto->category = $request->category;
        $producto->price = $request->price;
        $producto->stock = $request->stock; 
        $producto->description = $request->description;

        $producto->save();

        $producto = Producto::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock, // <- Este es clave
            'description' => $request->description,
        ]);
        
    }

    // Muestra la lista de productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function dashboard()
    {
        $productos = Producto::all();
        return view('dashboard', compact('productos'));
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
    public function update(Request $request, $id,Producto $producto)
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

        $producto->update($request->all());

        InventoryLog::create([
            'product_id' => $producto->id,
            'user_id' => auth()->id(),
            'type' => 'entrada',
            'quantity' => 0,
            'description' => 'Se actualizó la información del producto.',
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');

    }

    // Elimina un producto
    public function destroy($id)
{
    $producto = Producto::findOrFail($id);

    // Guardamos el stock antes de eliminar para registrar en el log
    $cantidadEliminada = $producto->stock;

    

    // Ahora sí se puede eliminar
    $producto->delete();

    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
}


}
