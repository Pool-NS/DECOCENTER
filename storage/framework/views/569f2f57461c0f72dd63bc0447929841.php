<?php $__env->startSection('content'); ?>
<style>
    .inventory-history-container {
        background: rgba(34, 34, 34, 0.85);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        color: #f0f0f0;
        max-width: 100%;
        margin: 2rem auto;
    }

    .inventory-history-container h2 {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #ffffff;
        margin-bottom: 1.5rem;
    }

    .table-dark-custom {
        width: 100%;
        border-collapse: collapse;
        background-color: #1e293b;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    }

    .table-dark-custom thead {
        background-color: #111827;
        color: #93c5fd;
    }

    .table-dark-custom th, .table-dark-custom td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #334155;
    }

    .table-dark-custom tbody tr:hover {
        background-color: #334155;
        transition: 0.2s ease;
    }

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-link {
        background-color: #1e293b;
        color: #93c5fd;
        border: none;
        margin: 0 3px;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #2563eb;
        color: white;
    }

    .pagination .active .page-link {
        background-color: #2563eb;
        color: white;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .table-dark-custom thead {
            display: none;
        }

        .table-dark-custom tr {
            display: block;
            margin-bottom: 1rem;
            border-bottom: 2px solid #334155;
        }

        .table-dark-custom td {
            display: block;
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        .table-dark-custom td::before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            width: 45%;
            padding-left: 0.5rem;
            font-weight: bold;
            text-align: left;
            color: #93c5fd;
        }
    }
</style>

<div class="inventory-history-container">
    <h2>Historial de Inventario</h2>

    <table class="table-dark-custom">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td data-label="Fecha"><?php echo e($log->created_at->format('d/m/Y H:i')); ?></td>
                <td data-label="Producto"><?php echo e($log->product->nombre); ?></td>
                <td data-label="Tipo"><?php echo e(ucfirst($log->type)); ?></td>
                <td data-label="Cantidad"><?php echo e($log->quantity); ?></td>
                <td data-label="Usuario"><?php echo e($log->user->name ?? 'Sistema'); ?></td>
                <td data-label="Descripción"><?php echo e($log->description); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php echo e($logs->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/inventory/logs.blade.php ENDPATH**/ ?>