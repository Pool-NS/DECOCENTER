<?php $__env->startSection('title', 'Reporte de ventas por mes'); ?>

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

<h1>Reporte de Ventas</h1>

<h2>Ventas Totales por Mes</h2>
<table>
    <thead>
        <tr>
            <th>Mes</th>
            <th>Total Vendido (S/.)</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $ventasPorMes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($venta->mes); ?></td>
                <td>S/. <?php echo e(number_format($venta->total_ventas, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<h2>Ventas por Producto</h2>
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Mes</th>
            <th>Total Vendido (S/.)</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $ventasPorProducto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(strtoupper($detalle->producto)); ?></td>
                <td><?php echo e($detalle->mes); ?></td>
                <td>S/. <?php echo e(number_format($detalle->total_ventas, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<a href="<?php echo e(route('dashboard')); ?>" class="btn-volver">Volver al Dashboard</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/reportes/ventas_por_mes.blade.php ENDPATH**/ ?>