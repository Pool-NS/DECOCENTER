@extends('layouts.plantilla')

@section('title', 'Vender Producto')

@section('content')
    <h1>Vender Producto: {{ $producto->name }}</h1>

    <form action="{{ route('productos.vender.procesar', $producto->id) }}" method="POST">
        @csrf
        <p>Stock disponible: <strong>{{ $producto->stock }}</strong></p>
        <p>Precio unitario: <strong>S/. {{ number_format($producto->price, 2) }}</strong></p>

        <label for="cantidad">Cantidad a vender:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" max="{{ $producto->stock }}" required>

        <p id="total">Total: S/. 0.00</p>

        <button type="submit">Confirmar Venta</button>
    </form>

    <a href="{{ route('productos.index') }}">Cancelar</a>

    <script>
        const cantidadInput = document.getElementById('cantidad');
        const totalDisplay = document.getElementById('total');
        const precio = {{ $producto->price }};

        cantidadInput.addEventListener('input', function() {
            const cantidad = parseInt(this.value) || 0;
            const total = (cantidad * precio).toFixed(2);
            totalDisplay.textContent = `Total: S/. ${total}`;
        });
    </script>
@endsection
