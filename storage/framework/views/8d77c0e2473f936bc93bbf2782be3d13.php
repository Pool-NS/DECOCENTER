<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row">
        <!-- Columna lateral para el color de fondo y mostrar el nombre del usuario -->
        <div class="col-md-3 bg-info py-4 h-auto align-self-start" style="border-radius: 8px;">
            <h4 class="text-white">Bienvenido, <?php echo e(Auth::user()->name); ?></h4>
            <hr class="border-white">
            <p class="text-white">Panel de Control de Inventario</p>
            <a href="<?php echo e(route('productos.index')); ?>" class="btn btn-primary btn-block mt-3 w-100">Ver Productos</a>
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|editor')): ?>
            <a href="<?php echo e(route('productos.create')); ?>" class="btn btn-primary btn-block mt-3 w-100">Agregar Producto</a>
            <?php endif; ?>
            <!-- Botón que abre el modal de Reportes -->
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
            <button type="button" class="btn btn-primary btn-block mt-3 w-100" data-bs-toggle="modal" data-bs-target="#modalReportes">
                📊 Reportes
            </button>
            <?php endif; ?>
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
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e(strtoupper($producto->name)); ?></h5>
                                <p class="card-text">
                                    <strong>Stock:</strong> <?php echo e($producto->stock); ?> <br>
                                    <strong>Precio:</strong> $<?php echo e(number_format($producto->price, 2)); ?> <br>
                                    <strong>Descripción:</strong> <?php echo e($producto->description); ?>

                                </p>

                                <!-- Botones de acción -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Editar -->
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|editor')): ?>
                                    <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <?php endif; ?>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|editor')): ?>
                                    <!-- Eliminar -->
                                    <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Reportes -->
<div class="modal fade" id="modalReportes" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalReportesLabel">📊 Reportes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>Selecciona el reporte que deseas visualizar:</p>
          <a href="<?php echo e(route('reportes.ventas_por_mes')); ?>" class="btn btn-outline-primary w-100 mb-2">📈 Ventas por mes</a>
          <a href="<?php echo e(route('reportes.productos_mas_vendidos')); ?>" class="btn btn-outline-primary w-100 mb-2">🔥 Productos más vendidos</a>
          <a href="<?php echo e(route('reportes.variacion_stock')); ?>" class="btn btn-outline-primary w-100 mb-2">⚠️ Variación de Stock</a>
          <a href="<?php echo e(route('reportes.usuarios_registrados')); ?>" class="btn btn-outline-primary w-100 mb-2">👥 Usuarios Registrados</a>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/dashboard.blade.php ENDPATH**/ ?>