<?php $__env->startSection('title', 'Lista de productos'); ?>

<?php $__env->startSection('content'); ?>
<style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #34495e;
        color: white;
    }

    .btn-agregar, .btn-regresar, .btn-salir {
        margin-top: 10px;
        padding: 10px 20px;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-agregar {
        background-color: #27ae60;
    }

    .btn-agregar:hover {
        background-color: #2ecc71;
    }

    .btn-regresar {
        background-color: #2980b9;
    }

    .btn-regresar:hover {
        background-color: #3498db;
    }

    .btn-salir {
        background-color: #c0392b;
    }

    .btn-salir:hover {
        background-color: #e74c3c;
    }

    .botones-navegacion {
        margin-top: 20px;
    }
</style>

<h1>Lista de Productos</h1>

<?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|editor')): ?>
<a href="<?php echo e(route('productos.create')); ?>" class="btn-agregar">Agregar Producto</a>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(strtoupper($producto->name)); ?></td>
                <td><?php echo e($producto->category); ?></td>
                <td><?php echo e($producto->stock); ?></td>
                <td>$<?php echo e(number_format($producto->price, 2)); ?></td>
                <td><?php echo e($producto->description); ?></td>
                <td>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|vendedor')): ?>
                    <a href="<?php echo e(route('productos.vender.form', $producto->id)); ?>" class="btn-agregar" style="background-color: #f39c12;">
                        Vender
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<div class="botones-navegacion">
    <a href="<?php echo e(url()->previous()); ?>" class="btn-regresar">Regresar</a>
    <a href="<?php echo e(route('home')); ?>" class="btn-salir">Salir</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/productos/index.blade.php ENDPATH**/ ?>