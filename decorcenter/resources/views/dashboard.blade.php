@extends('layouts.plantilla')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Columna lateral para el color de fondo y mostrar el nombre del usuario -->
        <div class="col-md-3 bg-info py-4" style="border-radius: 8px;">
            <h4 class="text-white">Bienvenido, {{ Auth::user()->name }}</h4>
            <hr class="border-white">
            <p class="text-white">Panel de Control de Inventario</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary btn-block">Ver Productos</a>
            <a href="{{ route('productos.create') }}" class="btn btn-primary btn-block mt-3">Agregar Producto</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-block mt-3">Panel de Control</a>
        </div>

        <!-- Columna para mostrar los productos -->
        <div class="col-md-9">
            <h1 class="mb-4 text-center">Bienvenido al Panel de Inventario</h1>
            
            <div class="row mb-3">
                <div class="col text-center">
                    <h3>Productos en Inventario</h3>
                </div>
            </div>

            <!-- Mostramos los productos en tarjetas -->
            <div class="row">
                @foreach ($productos as $producto)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">
                                    <strong>Stock:</strong> {{ $producto->stock }} <br>
                                    <strong>Precio:</strong> ${{ number_format($producto->precio, 2) }} <br>
                                </p>

                                <!-- Botones de acción -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Editar -->
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <!-- Eliminar -->
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
