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

<form class="row g-3" method="post" action="<?= base_url('usuarios/' . $datos_personales['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $datos_personales['id'] ?>">

    <div class="col-md-3">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= esc($datos_personales['nombre']); ?>" required
            autofocus>
    </div>
    <div class="col-md-3">
        <label for="paterno" class="form-label"><span class="text-danger">*</span> Paterno</label>
        <input type="text" class="form-control" id="paterno" name="paterno" value="<?= esc($datos_personales['paterno']); ?>"
            required autofocus>
    </div>
    <div class="col-md-3">
        <label for="materno" class="form-label"> Materno</label>
        <input type="text" class="form-control" id="materno" name="materno" value="<?= esc($datos_personales['materno']); ?>"
            required autofocus>
    </div>
    <div class="col-md-3">
        <label for="cedula_identidad" class="form-label"><span class="text-danger">*</span> Cedula Identidad</label>
        <input type="text" class="form-control" id="cedula_identidad" name="cedula_identidad"
            value="<?= esc($datos_personales['cedula_identidad']); ?>" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="email" class="form-label"><span class="text-danger">*</span> Correo Electronico</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= esc($datos_personales['email']); ?>" required>
    </div>
    <div class="col-md-3">
        <label for="celular" class="form-label"><span class="text-danger">*</span> Celular</label>
        <input type="text" class="form-control" id="celular" name="celular" value="<?= esc($datos_personales['celular']); ?>"
            required autofocus>
    </div>

    <div class="col-md-9">
        <label for="direccion" class="form-label"><span class="text-danger">*</span> Direccion</label>
        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= esc($datos_personales['direccion']); ?>"
            required>
    </div>
    <div class="col-md-3">
        <label for="fecha_nacimiento" class="form-label"><span class="text-danger">*</span> Fecha de nacimiento</label>
        <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
            value="<?= esc($datos_personales['fecha_nacimiento']); ?>" required autofocus>
    </div>
    <div class="col-md-3">
        <label for="id_pais" class="form-label"><span class="text-danger">*</span> Pais</label>
        <select class="form-select" id="id_pais" name="id_pais" required>
            <option value="">Seleccionar</option>
            <?php foreach ($pais as $paises) : ?>
                <option value="<?= $paises['id']; ?>" <?php echo ($paises['id'] == $datos_personales['id_pais']) ? 'selected' : ''; ?>><?= $paises['nombre_pais']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="id_ciudad_registro" class="form-label"><span class="text-danger">*</span> Ciudad de registro</label>
        <select class="form-select" id="id_ciudad_registro" name="id_ciudad_registro" required>
            <option value="">Seleccionar</option>
            <?php foreach ($ciudad as $ciudades) : ?>
                <option value="<?= $ciudades['id']; ?>" <?php echo ($ciudades['id'] == $datos_personales['id_ciudad_registro']) ? 'selected' : ''; ?>><?= $ciudades['nombre_ciudad']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('usuarios'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>




<?php $this->endSection(); ?>