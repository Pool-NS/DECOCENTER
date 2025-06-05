<?php $__env->startSection('title', 'Usuarios Registrados'); ?>

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
        background-color: #34495e;
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

    h1 {
        margin-top: 40px;
        color: #2c3e50;
    }
</style>

<h1>Reporte de Usuarios Registrados</h1>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Registro</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($usuario->name); ?></td>
                <td><?php echo e($usuario->email); ?></td>
                <td><?php echo e($usuario->created_at->format('d/m/Y')); ?></td>
                <td><?php echo e($usuario->getRoleNames()->first() ?? 'Sin rol'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<a href="<?php echo e(route('dashboard')); ?>" class="btn-volver">Volver al Dashboard</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/reportes/usuarios_registrados.blade.php ENDPATH**/ ?>