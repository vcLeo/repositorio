<?php

$this->extend('plantilla/layout');
$this->section('contenido');
?>
<div class="pagetitle">
    <h1>Modificar Programas</h1>
</div>

<!-- Mensajes de validación -->
<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null): ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('programas/' . $programa['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $programa['id'] ?>">

    <div class="col-md-4">
        <label for="nombre_programa" class="form-label"><span class="text-danger">*</span> Nombre programa</label>
        <input type="text" class="form-control" id="nombre_programa" name="nombre_programa" value="<?= esc($programa['nombre_programa']); ?>" required
            autofocus>
    </div>
    <div class="col-md-4">
        <label for="version" class="form-label"><span class="text-danger">*</span> Version</label>
        <input type="text" class="form-control" id="version" name="version" value="<?= esc($programa['version']); ?>"
            required autofocus>
    </div>
    <div class="col-md-6">
        <label for="id_tipo_programa" class="form-label"><span class="text-danger">*</span> Tipo Programa</label>
        <select class="form-select" id="id_tipo_programa" name="id_tipo_programa" required>
            <option value="">Seleccionar</option>
            <?php foreach ($tipo_programa as $tipo) : ?>

                <option value="<?= $tipo['id']; ?>" <?php echo ($tipo['id'] == $programa['id_tipo_programa']) ? 'selected' : ''; ?>><?= $tipo['nombre_tipo_programa']; ?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('programas'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>




<?php $this->endSection(); ?>