<?php

namespace App\Models;

use CodeIgniter\Model;

class PosgraduanteModel extends Model
{
    protected $table            = 'posgraduante';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nro_matricula', 'id_datos_personales'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];
}
