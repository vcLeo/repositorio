<?php

$this->extend('plantilla/layout');
$this->section('contenido');
?>
<!-- titulo de pagina-->
<div class="pagetitle">
    <h1>Registro de Documentos</h1>
</div>
<div class="centrado">
    <p>
        <a href="<?= base_url('documentos/new'); ?>" class="btn btn-primary btn-sm">
            <i class="bx bxs-plus-square"></i> Nuevo Registro
        </a>
    </p>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body table-responsive">

                    <!-- Tabla de registros -->
                    <table class="table table-bordered table-hover table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Numero de Folio</th>
                                <th>Resumen</th>

                                <th>Programa</th>
                                <th>Ciudad Registro</th>
                                <th>Tipo Modalidad</th>
                                <th>Archivo Documento</th>
                                <th>Fecha Registro</th>
                                <th>Fecha Modificacion</th>
                                <th style="width: 3%"></th>
                                <th style="width: 3%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $documentos): ?>
                                <tr>
                                    <td><?= $documentos['titulo']; ?></td>
                                    <td><?= $documentos['numero_folio']; ?></td>
                                    <td><?= $documentos['resumen']; ?></td>
                                    <td><?= $documentos['programas']; ?></td>
                                    <td><?= $documentos['ciudades']; ?></td>
                                    <td><?= $documentos['modalidad']; ?></td>
                                    <td><?= $documentos['id_respaldo_digital']; ?></td>
                                    <td><?= $documentos['created_at']; ?></td>
                                    <td><?= $documentos['updated_at']; ?></td>
                                    <td>
                                        <a class='btn btn-warning btn-sm' href='<?= base_url('documentos/' . $documentos['id'] . '/edit'); ?>'
                                            rel='tooltip' data-bs-placement='top' title='Modificar registro'>
                                            <span class='bx bxs-edit'></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class='btn btn-danger btn-sm' href='#' data-bs-href='<?= base_url('documentos/' . $documentos['id']); ?>'
                                            rel='tooltip' data-bs-toggle='modal' data-bs-target='#confirmaModal' data-bs-placement='top'
                                            title='Eliminar registro'>
                                            <span class='bx bxs-trash'></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>
<!-- Modal -->
<!-- <div class=" modal fade" id="confirmaModal" tabindex="-1" aria-labelledby="confirmaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmaModalLabel">Eliminar registro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <form action="" method="post" id="form-elimina">
          <input type="hidden" name="_method" value="DELETE">
          
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<!-- Modal -->
<div class="modal fade" id="confirmaModal" tabindex="-1" aria-labelledby="confirmaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmaModalLabel">Eliminar registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="form-elimina">
                    <input type="hidden" name="_method" value="DELETE">
                    <?= csrf_field(); ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para el Mensaje de Confirmación -->
<div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mensajeModalLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="text-success">EL DOCUMENTO SE ELIMINÓ CORRECTAMENTE</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>




<?php $this->endSection();
$this->section('script'); ?>
<script>
    // Interceptar el envío del formulario
    $('#form-elimina').on('submit', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto de envío del formulario

        // Obtener la URL del formulario y los datos
        var url = $(this).attr('action');
        var data = $(this).serialize();

        // Enviar la solicitud AJAX
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (!response.success) {
                    $('#confirmaModal').modal('hide'); // Ocultar el modal de confirmación
                    $('#mensajeModal').modal('show'); // Mostrar el modal de mensaje

                    // Opcional: recargar la página después de cerrar el mensaje modal
                    $('#mensajeModal').on('hidden.bs.modal', function() {
                        location.reload(); // Recargar la página para actualizar la lista de registros
                    });
                }
            },
            error: function() {
                alert('Hubo un error en el servidor. Intente de nuevo más tarde.');
            }
        });
    });
</script>
<script>
    $(document).ready(function(e) {

        $('#dataTable').DataTable({
            "language": {
                "url": "<?= base_url('js/DatatablesSpanish.json'); ?>"
            },
            "pageLength": 10,
            "order": [
                [0, "asc"]
            ]
        });
    });

    const confirmaModal = document.getElementById('confirmaModal')
    confirmaModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const url = button.getAttribute('data-bs-href')

        const formElimina = confirmaModal.querySelector('.modal-footer #form-elimina')
        formElimina.action = url
    })
</script>

<?php $this->endSection(); ?>