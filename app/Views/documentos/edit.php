<?php

$this->extend('plantilla/layout');
$this->section('contenido');
?>
<div class="pagetitle">
    <h1>Modificar Documentos</h1>
</div>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null): ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('documentos/' . $documentos['id']); ?>" autocomplete="off">

    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $documentos['id'] ?>">


    <div class="col-md-3">
        <label for="titulo" class="form-label"><span class="text-danger">*</span> Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= esc($documentos['titulo']); ?>" required
            autofocus>
    </div>
    <div class="col-md-3">
        <label for="numero_folio" class="form-label"><span class="text-danger">*</span> Numero_folio</label>
        <input type="text" class="form-control" id="numero_folio" name="numero_folio" value="<?= esc($documentos['numero_folio']); ?>"
            required autofocus>
    </div>
    <div class="col-md-3">
        <label for="resumen" class="form-label"><span class="text-danger">*</span> Resumen</label>
        <input type="text" class="form-control" id="resumen" name="resumen" value="<?= esc($documentos['resumen']); ?>"
            required autofocus>
    </div>
    <div class="col-md-3">
        <label for="id_programa" class="form-label"><span class="text-danger">*</span> Programa</label>
        <select class="form-select" id="id_programa" name="id_programa" required>
            <option value="">Seleccionar</option>
            <?php foreach ($programa as $programas) : ?>
                <option value="<?= $programas['id']; ?>" <?php echo ($programas['id'] == $documentos['id_programa']) ? 'selected' : ''; ?>><?= $programas['nombre_programa']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="id_ciudad" class="form-label"><span class="text-danger">*</span> Ciudad de Registro</label>
        <select class="form-select" id="id_ciudad" name="id_ciudad" required>
            <option value="">Seleccionar</option>
            <?php foreach ($ciudad as $ciudades) : ?>
                <option value="<?= $ciudades['id']; ?>" <?php echo ($ciudades['id'] == $documentos['id_ciudad']) ? 'selected' : ''; ?>><?= $ciudades['nombre_ciudad']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="id_tipo_modalidad" class="form-label"><span class="text-danger">*</span> Modalidad de Graduacion</label>
        <select class="form-select" id="id_tipo_modalidad" name="id_tipo_modalidad" required>
            <option value="">Seleccionar</option>
            <?php foreach ($tipo_modalidad as $modalidad) : ?>
                <option value="<?= $modalidad['id']; ?>" <?php echo ($modalidad['id'] == $documentos['id_tipo_modalidad']) ? 'selected' : ''; ?>><?= $modalidad['nombre_modalidad']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="id_respaldo_digital" class="form-label"><span class="text-danger">*</span> Respaldo Digital</label>
        <input type="text" class="form-control" id="id_respaldo_digital" name="id_respaldo_digital" value="<?= esc($documentos['id_respaldo_digital']); ?>"
            required autofocus>
        <!-- <select class="form-select" id="id_respaldo_digital" name="id_respaldo_digital" required>
            <option value="">Seleccionar</option>

        </select> -->
    </div>

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-12">
        <a href="<?= base_url('documentos'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>


<?php $this->endSection(); ?>