<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;
use App\Models\CiudadModel;
use App\Models\PaisModel;
use App\Models\UserModel;

class Usuarios extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UserModel();
        helper(['form']);
    }
    public function index()
    {
        $datos = $this->usuariosModel->usuariosCiudadPais();
        return view('usuarios/index', ['datos' => $datos]);
    }


    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        // Cargar los modelos
        $paisModel = new PaisModel();
        $ciudadModel = new CiudadModel();

        // Obtener los datos de los modelos
        $data['pais'] = $paisModel->findAll();
        $data['ciudad'] = $ciudadModel->findAll();

        // Pasar todos los datos a la vista en un solo array
        return view('usuarios/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'nombre' => 'required|alpha_space|min_length[2]|max_length[50]',
            'paterno' => 'required|alpha_space|min_length[2]|max_length[50]',
            'materno' => 'permit_empty|alpha_space|min_length[0]|max_length[50]',
            'cedula_identidad' => 'required', // Ajusta el tamaño según el formato
            'email' => 'required|max_length[100]',
            'celular' => 'required|numeric|min_length[8]|max_length[15]', // Ajusta el tamaño según el formato
            'direccion' => 'required|string|max_length[255]',
            'fecha_nacimiento' => 'required|valid_date[Y-m-d]',
            'id_pais' => 'required|is_not_unique[pais.id]',
            'id_ciudad_registro' => 'required|is_not_unique[ciudad.id]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['nombre', 'paterno', 'materno', 'cedula_identidad', 'email', 'celular', 'direccion', 'fecha_nacimiento', 'id_pais', 'id_ciudad_registro']);

        $this->usuariosModel->insert([
            'nombre' => $post['nombre'],
            'paterno' => $post['paterno'],
            'materno' => $post['materno'],
            'cedula_identidad' => $post['cedula_identidad'],
            'email' => $post['email'],
            'celular' => $post['celular'],
            'direccion' => $post['direccion'],
            'fecha_nacimiento' => $post['fecha_nacimiento'],
            'id_pais' => $post['id_pais'],
            'id_ciudad_registro' => $post['id_ciudad_registro'],

        ]);
        return redirect()->to('usuarios');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('usuarios');
        }

        // Cargar los modelos
        $paisModel = new PaisModel();
        $ciudadModel = new CiudadModel();
        $usuariosModel = new UserModel(); // Asegúrate de que este sea el nombre correcto de tu modelo para usuarios

        // Obtener los datos de los modelos
        $data['pais'] = $paisModel->findAll();
        $data['ciudad'] = $ciudadModel->findAll();
        $data['datos_personales'] = $usuariosModel->find($id);

        // Verificar si el usuario existe
        if (!$data['datos_personales']) {
            // Opcional: Redirigir si el usuario no se encuentra
            return redirect()->to('usuarios');
        }

        // Pasar los datos a la vista
        return view('usuarios/edit', $data);
    }


    // Valida y actualiza registro
    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('usuarios');
        }

        $reglas = [
            'nombre' => 'required|alpha_space|min_length[2]|max_length[50]',
            'paterno' => 'required|alpha_space|min_length[2]|max_length[50]',
            'materno' => 'permit_empty|alpha_space|min_length[0]|max_length[50]',
            'cedula_identidad' => ['rules' => "required|is_unique[datos_personales.cedula_identidad,id,{$id}]"], // Ajusta el tamaño según el formato
            'email' => 'required|max_length[100]',
            'celular' => 'required|numeric|min_length[8]|max_length[15]', // Ajusta el tamaño según el formato
            'direccion' => 'required|string|max_length[255]',
            'fecha_nacimiento' => 'required|valid_date[Y-m-d]',
            'id_pais' => 'required|is_not_unique[pais.id]',
            'id_ciudad_registro' => 'required|is_not_unique[ciudad.id]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['nombre', 'paterno', 'materno', 'cedula_identidad', 'email', 'celular', 'direccion', 'fecha_nacimiento', 'id_pais', 'id_ciudad_registro']);

        $this->usuariosModel->update($id, [
            'nombre' => $post['nombre'],
            'paterno' => $post['paterno'],
            'materno' => $post['materno'],
            'cedula_identidad' => $post['cedula_identidad'],
            'email' => $post['email'],
            'celular' => $post['celular'],
            'direccion' => $post['direccion'],
            'fecha_nacimiento' => $post['fecha_nacimiento'],
            'id_pais' => $post['id_pais'],
            'id_ciudad_registro' => $post['id_ciudad_registro'],

        ]);
        return redirect()->to('usuarios');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if (!$this->request->is('delete') || $id == null) {
            return redirect()->route('usuarios');
        }
        $this->usuariosModel->delete($id);
        return redirect()->to('usuarios');
    }
}
