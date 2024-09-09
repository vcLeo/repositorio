<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramasModel extends Model
{
    protected $table            = 'programa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre_programa', 'version', 'id_tipo_programa'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    public function tipoProgramas()
    {
        return $this->select('programa. * , tipo_programa.nombre_tipo_programa AS programa')->join('tipo_programa', 'programa.id_tipo_programa = tipo_programa.id')->findAll();
    }
}
