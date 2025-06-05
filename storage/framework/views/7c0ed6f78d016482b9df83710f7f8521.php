<?php $__env->startSection('title', 'Vender Producto'); ?>

<?php $__env->startSection('content'); ?>
<style>
    form {
        max-width: 400px;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }

    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-confirmar {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #27ae60;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-confirmar:hover {
        background-color: #2ecc71;
    }

    a.cancelar {
        display: inline-block;
        margin-top: 15px;
        color: #2980b9;
        text-decoration: none;
        font-weight: bold;
    }

    a.cancelar:hover {
        text-decoration: underline;
    }

    p {
        font-size: 1.1em;
        margin-top: 10px;
    }

    #total {
        font-weight: bold;
        margin-top: 15px;
        font-size: 1.2em;
        color: #2c3e50;
    }
</style>

<h1>Vender Producto: <?php echo e(strtoupper($producto->name)); ?></h1>

<form action="<?php echo e(route('productos.vender.procesar', $producto->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <p>Stock disponible: <strong><?php echo e($producto->stock); ?></strong></p>
    <p>Precio unitario: <strong>S/. <?php echo e(number_format($producto->price, 2)); ?></strong></p>

    <label for="cantidad">Cantidad a vender:</label>
    <input type="number" name="cantidad" id="cantidad" min="1" max="<?php echo e($producto->stock); ?>" required>

    <p id="total">Total: S/. 0.00</p>

    <button type="submit" class="btn-confirmar">Confirmar Venta</button>
</form>

<a href="<?php echo e(route('productos.index')); ?>" class="cancelar">Cancelar</a>

<script>
    const cantidadInput = document.getElementById('cantidad');
    const totalDisplay = document.getElementById('total');
    const precio = <?php echo e($producto->price); ?>;

    cantidadInput.addEventListener('input', function() {
        const cantidad = parseInt(this.value) || 0;
        const total = (cantidad * precio).toFixed(2);
        totalDisplay.textContent = `Total: S/. ${total}`;
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/productos/vender.blade.php ENDPATH**/ ?>