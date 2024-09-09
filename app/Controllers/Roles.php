<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\RolesUserModel;
use App\Models\UserModel;

class Roles extends BaseController
{
    protected $rolesModel;
    public function __construct()
    {
        $this->rolesModel = new RolesUserModel();
        helper(['form']);
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $datos = $this->rolesModel->rolesUsuarios();
        return view('roles/index', ['datos' => $datos]);
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
        $rolModel = new RolesModel();
        $datosModel = new UserModel();
        $data['roles'] = $rolModel->findAll();
        $data['datos_personales'] = $datosModel->findAll();
        return view('roles/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'usuario' => 'required|alpha_space|min_length[2]|max_length[50]',
            'password' => 'required|min_length[2]|max_length[50]',
            'estado' => 'permit_empty|in_list[0,1]',
            'id_rol' => 'required|is_not_unique[roles.id]',
            'id_datos_personales' => 'required|is_not_unique[datos_personales.id]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['usuario', 'password', 'estado', 'id_rol', 'id_datos_personales']);

        $this->rolesModel->insert([
            'usuario' => $post['usuario'],
            'password' => $post['password'],
            'estado' => $post['estado'],
            'id_rol' => $post['id_rol'],
            'id_datos_personales' => $post['id_datos_personales'],

        ]);
        return redirect()->to('roles');
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
            return redirect()->to('roles');
        }
        $rolModel = new RolesModel();
        $datosModel = new UserModel();
        $rolesUsuariosModel = new RolesUserModel();
        $data['roles'] = $rolModel->findAll();
        $data['datos_personales'] = $datosModel->findAll();
        $data['roles_usuarios'] = $rolesUsuariosModel->find($id);
        if (!$data['roles_usuarios']) {
            // Opcional: Redirigir si el usuario no se encuentra
            return redirect()->to('roles');
        }

        return view('roles/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('roles');
        }
        $reglas = [
            'usuario' => 'required|alpha_space|min_length[2]|max_length[50]',
            'password' => 'required|min_length[2]|max_length[50]',
            'estado' => 'permit_empty|in_list[0,1]',
            'id_rol' => 'required|is_not_unique[roles.id]',
            'id_datos_personales' => 'required|is_not_unique[datos_personales.id]',
        ];
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['usuario', 'password', 'estado', 'id_rol', 'id_datos_personales']);

        $this->rolesModel->update($id, [
            'usuario' => $post['usuario'],
            'password' => $post['password'],
            'estado' => $post['estado'],
            'id_rol' => $post['id_rol'],
            'id_datos_personales' => $post['id_datos_personales'],

        ]);
        return redirect()->to('roles');
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
            return redirect()->route('roles');
        }
        $this->rolesModel->delete($id);
        return redirect()->to('roles');
    }
}
