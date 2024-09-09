<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;
use App\Models\ProgramasModel;
use App\Models\TipoProgramasModel;

class Programas extends BaseController
{
    protected $programasModel;
    public function __construct()
    {
        $this->programasModel = new ProgramasModel();
        helper(['form']);
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $datos = $this->programasModel->tipoProgramas();
        return view('programas/index', ['datos' => $datos]);
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
        $tipoProgramaModel = new TipoProgramasModel();
        $data['tipo_programa'] = $tipoProgramaModel->findAll();
        return view('programas/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'nombre_programa' => 'required|alpha_space|min_length[2]|max_length[500]',
            'version' => 'required|min_length[1]|max_length[10]',
            'id_tipo_programa' => 'required|is_not_unique[tipo_programa.id]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['nombre_programa', 'version', 'id_tipo_programa']);

        $this->programasModel->insert([
            'nombre_programa' => $post['nombre_programa'],
            'version' => $post['version'],
            'id_tipo_programa' => $post['id_tipo_programa'],

        ]);
        return redirect()->to('programas');
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
            return redirect()->to('programas');
        }

        // Cargar los modelos
        $tipoProgramaModel = new TipoProgramasModel();
        $programaModel = new ProgramasModel(); // Asegúrate de que este sea el nombre correcto de tu modelo para usuarios

        // Obtener los datos de los modelos
        $data['tipo_programa'] = $tipoProgramaModel->findAll();
        $data['programa'] = $programaModel->find($id);

        // Pasar los datos a la vista
        return view('programas/edit', $data);
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
        if ($id === null) {
            return redirect()->to('programas');
        }
        $reglas = [
            'nombre_programa' => 'required|alpha_space|min_length[2]|max_length[500]',
            'version' => 'required|min_length[1]|max_length[10]',
            'id_tipo_programa' => 'required|is_not_unique[tipo_programa.id]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['nombre_programa', 'version', 'id_tipo_programa']);

        $this->programasModel->update($id, [
            'nombre_programa' => $post['nombre_programa'],
            'version' => $post['version'],
            'id_tipo_programa' => $post['id_tipo_programa'],

        ]);
        return redirect()->to('programas');
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
        //
    }
}
