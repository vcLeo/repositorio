<?php

$this->extend('plantilla/layout');
$this->section('contenido');
?>
<div class="pagetitle">
    <h1>Asignacion de Usuarios</h1>
</div>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null): ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('roles'); ?>" autocomplete="off">

    <?= csrf_field(); ?>

    <div class="col-md-4">
        <label for="usuario" class="form-label"><span class="text-danger">*</span> Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= set_value('usuario'); ?>" required
            autofocus>
    </div>
    <div class="col-md-4">
        <label for="password" class="form-label"><span class="text-danger">*</span> Password</label>
        <input type="text" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>"
            required autofocus>
    </div>
    <div class="col-md-4">
        <label for="estado" class="form-label"> estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="<?= set_value('estado'); ?>"
            required autofocus>
    </div>
    <div class="col-md-6">
        <label for="id_rol" class="form-label"><span class="text-danger">*</span> Rol</label>
        <select class="form-select" id="id_rol" name="id_rol" required>
            <option value="">Seleccionar</option>
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id']; ?>"><?= $rol['nombre_rol']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="id_datos_personales" class="form-label"><span class="text-danger">*</span> Nombre Completo del Usuario</label>
        <select class="form-select" id="id_datos_personales" name="id_datos_personales" required>
            <option value="">Seleccionar</option>
            <?php foreach ($datos_personales as $persona) : ?>
                <option value="<?= esc($persona['id']); ?>">
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