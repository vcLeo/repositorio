<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'datos_personales';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['nombre', 'paterno', 'materno', 'cedula_identidad', 'email', 'celular', 'direccion', 'fecha_nacimiento', 'id_pais', 'id_ciudad_registro'];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function usuariosCiudadPais()
    {
        return $this->select('datos_personales.*, pais.nombre_pais AS paises, ciudad.nombre_ciudad AS ciudades')
            ->join('pais', 'pais.id = datos_personales.id_pais', 'left')
            ->join('ciudad', 'ciudad.id = datos_personales.id_ciudad_registro', 'left')
            ->findAll();
    }
}
