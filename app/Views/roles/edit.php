<?php

$this->extend('plantilla/layout');
$this->section('contenido');
?>
<div class="pagetitle">
    <h1>Modificar Registros</h1>
</div>

<!-- Mensajes de validación -->
<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null): ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('roles/' . $roles_usuarios['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $roles_usuarios['id'] ?>">

    <div class="col-md-4">
        <label for="usuario" class="form-label"><span class="text-danger">*</span> Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= esc($roles_usuarios['usuario']); ?>" required
            autofocus>
    </div>
    <div class="col-md-4">
        <label for="password" class="form-label"><span class="text-danger">*</span> Password</label>
        <input type="text" class="form-control" id="password" name="password" value="<?= esc($roles_usuarios['password']); ?>"
            required autofocus>
    </div>
    <div class="col-md-4">
        <label for="estado" class="form-label"> estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?= esc($roles_usuarios['estado']); ?>"
            required autofocus>
    </div>
    <div class="col-md-6">
        <label for="id_rol" class="form-label"><span class="text-danger">*</span> Rol</label>
        <select class="form-select" id="id_rol" name="id_rol" required>
            <option value="">Seleccionar</option>
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id']; ?>" <?php echo ($rol['id'] == $roles_usuarios['id_rol']) ? 'selected' : ''; ?>><?= $rol['nombre_rol']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="id_datos_personales" class="form-label"><span class="text-danger">*</span> Nombre Completo del Usuario</label>
        <select class="form-select" id="id_datos_personales" name="id_datos_personales" required>
            <option value="">Seleccionar</option>
            <?php foreach ($datos_personales as $persona) : ?>
                <option value="<?= esc($persona['id']); ?>"
                    <?php echo ($persona['id'] == $roles_usuarios['id_datos_personales']) ? 'selected' : ''; ?>>
                    <?= esc($persona['nombre'] . ' ' . $persona['paterno'] . ' ' . $persona['materno']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('roles'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>




<?php $this->endSection(); ?>