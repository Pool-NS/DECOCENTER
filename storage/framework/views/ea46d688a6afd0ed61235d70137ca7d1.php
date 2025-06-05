<?php $__env->startSection('title', 'Crear producto'); ?>

<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, #1f1f1f, #2e3b4e);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Estilo del contenedor del formulario */
    .form-container {
        background: rgba(34, 34, 34, 0.85); /* Fondo oscuro y elegante */
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        color: #f0f0f0;
        width: 400px;
        max-width: 100%;
        margin: 50px auto; /* Centrado del formulario */
    }

    h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        font-weight: 600;
        color: #ffffff;
    }

    label {
        display: block;
        margin-bottom: 1rem;
        font-weight: 500;
        color: #f0f0f0;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 0.6rem;
        margin-top: 0.3rem;
        border: none;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    input::placeholder, textarea::placeholder {
        color: #cccccc;
    }

    textarea {
        resize: none;
    }

    button {
        width: 100%;
        padding: 0.8rem;
        border: none;
        border-radius: 10px;
        background-color: #bfa26f;
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #toggleSidebar {
        width: auto !important;
        padding: 0.25rem 0.75rem !important;
    }

    button:hover {
        background-color: #a88e56;
    }

    span {
        color: #ffb3b3;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .btn-volver {
        display: block;
        text-align: center;
        margin-top: 1rem;
        padding: 0.6rem;
        background-color: #ffffff22;
        color: white;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-volver:hover {
        background-color: #ffffff40;
    }

    /* Ajustes responsivos */
    @media (max-width: 768px) {
        .form-container {
            width: 90%; /* Ajustar tamaño en pantallas pequeñas */
            padding: 1.5rem;
        }
    }

</style>

<!-- Contenedor principal para el formulario -->
<div class="form-container">
    <h1>Crear producto</h1>

    <form action="<?php echo e(route('productos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <label>
            Nombre del producto:
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Ej. Silla de oficina" required>
        </label>
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span>*<?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label>
            Categoría:
            <input type="text" name="category" value="<?php echo e(old('category')); ?>" placeholder="Ej. Muebles" required>
        </label>
        <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span>*<?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label>
            Precio:
            <input type="number" name="price" step="0.01" value="<?php echo e(old('price')); ?>" placeholder="Ej. 149.99" required>
        </label>
        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span>*<?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <label>
            Stock:
            <input type="number" name="stock" value="<?php echo e(old('stock')); ?>" placeholder="Ej. 20" required>
        </label>
        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span>*<?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        
        <label>
            Descripción:
            <textarea name="description" rows="5" placeholder="Describe el producto"><?php echo e(old('description')); ?></textarea>
        </label>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span>*<?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <button type="submit">Enviar Producto</button>
    </form>

    <a href="<?php echo e(route('productos.index')); ?>" class="btn-volver">← Volver a Productos</a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/productos/create.blade.php ENDPATH**/ ?>