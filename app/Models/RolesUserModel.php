<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesUserModel extends Model
{
    protected $table            = 'roles_usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['usuario', 'password', 'estado', 'id_rol', 'id_datos_personales'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    public function rolesUsuarios()
    {
        return $this->select('roles_usuarios.*, roles.nombre_rol AS rol, CONCAT(datos_personales.nombre, " ", datos_personales.paterno, " ", datos_personales.materno) AS datos')
            ->join('roles', 'roles.id = roles_usuarios.id_rol', 'left')
            ->join('datos_personales', 'datos_personales.id = roles_usuarios.id_datos_personales', 'left')
            ->findAll();
    }
}
