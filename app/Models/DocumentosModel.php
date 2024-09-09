<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentosModel extends Model
{
    protected $table            = 'documentos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['titulo', 'numero_folio', 'resumen', 'id_programa', 'id_ciudad', 'id_tipo_modalidad', 'id_respaldo_digital'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';


    public function documentosDatos()
    {
        return $this->select('documentos.*, programa.nombre_programa AS programas, ciudad.nombre_ciudad AS ciudades,tipo_modalidad.nombre_modalidad AS modalidad')
            ->join('programa', 'programa.id = documentos.id_programa', 'left')
            ->join('ciudad', 'ciudad.id = documentos.id_ciudad', 'left')
            ->join('tipo_modalidad', 'tipo_modalidad.id = documentos.id_tipo_modalidad', 'left')
            ->findAll();
    }
}
