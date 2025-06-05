<?php $__env->startSection('title', 'Variación de Stock'); ?>

<?php $__env->startSection('content'); ?>
<style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    .btn-volver {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #2980b9;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }

    .btn-volver:hover {
        background-color: #3498db;
    }

    h2 {
        margin-top: 40px;
        color: #2c3e50;
    }
</style>

<h1>Reporte de Variación de Stock (por Fecha y Producto)</h1>

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Entradas</th>
            <th>Salidas</th>
            <th>Stock Actual</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->fecha); ?></td>
                <td><?php echo e(strtoupper($item->producto)); ?></td>
                <td><?php echo e($item->entradas); ?></td>
                <td><?php echo e($item->salidas); ?></td>
                <td><?php echo e($stocksActuales[$item->producto] ?? 'N/A'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<a href="<?php echo e(route('dashboard')); ?>" class="btn-volver">Volver al Dashboard</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/reportes/variacion_stock.blade.php ENDPATH**/ ?>