<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\BaseController;
use App\Models\CiudadModel;
use App\Models\DocumentosModel;
use App\Models\ModalidadModel;
use App\Models\ProgramasModel;

class Documentos extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    protected $documentosModel;

    public function __construct()
    {
        $this->documentosModel = new DocumentosModel();
        helper(['form']);
    }
    public function index()
    {
        $datos = $this->documentosModel->documentosDatos();
        return view('documentos/index', ['datos' => $datos]);
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
        $programasModel = new ProgramasModel();
        $modalidadModel = new ModalidadModel();
        $ciudadmodel = new CiudadModel();

        // Obtener los datos de los modelos
        $data['programa'] = $programasModel->findAll();
        $data['tipo_modalidad'] = $modalidadModel->findAll();
        $data['ciudad'] = $ciudadmodel->findAll();

        //$data['respaldo_digital'] = $ciudadmodel->findAll(); este falta

        // Pasar todos los datos a la vista en un solo array
        return view('documentos/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'titulo' => 'required|alpha_space|min_length[2]|max_length[250]',
            'numero_folio' => 'required',
            'resumen' => 'required|alpha_space|min_length[2]|max_length[500]',
            'id_programa' => 'required|is_not_unique[programa.id]',
            'id_ciudad' => 'required|is_not_unique[ciudad.id]',
            'id_tipo_modalidad' => 'required|is_not_unique[tipo_modalidad.id]',
            'id_respaldo_digital' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost([
            'titulo',
            'numero_folio',
            'resumen',
            'id_programa',
            'id_ciudad',
            'id_tipo_modalidad',
            'id_respaldo_digital'
        ]);

        $this->documentosModel->insert([
            'titulo' => $post['titulo'],
            'numero_folio' => $post['numero_folio'],
            'resumen' => $post['resumen'],
            'id_programa' => $post['id_programa'],
            'id_ciudad' => $post['id_ciudad'],
            'id_tipo_modalidad' => $post['id_tipo_modalidad'],
            'id_respaldo_digital' => $post['id_respaldo_digital'],

        ]);
        return redirect()->to('documentos');
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
            return redirect()->to('documentos');
        }
        // Cargar los modelos
        $programasModel = new ProgramasModel();
        $modalidadModel = new ModalidadModel();
        $ciudadmodel = new CiudadModel();
        $documentosModel = new DocumentosModel();

        // Obtener los datos de los modelos
        $data['programa'] = $programasModel->findAll();
        $data['tipo_modalidad'] = $modalidadModel->findAll();
        $data['ciudad'] = $ciudadmodel->findAll();
        $data['documentos'] = $documentosModel->find($id);

        //$data['respaldo_digital'] = $ciudadmodel->findAll(); este falta

        // Pasar todos los datos a la vista en un solo array
        return view('documentos/edit', $data);
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
            return redirect()->to('documentos');
        }

        $reglas = [
            'titulo' => 'required|alpha_space|min_length[2]|max_length[250]',
            'numero_folio' => 'required',
            'resumen' => 'required|alpha_space|min_length[2]|max_length[500]',
            'id_programa' => 'required|is_not_unique[programa.id]',
            'id_ciudad' => 'required|is_not_unique[ciudad.id]',
            'id_tipo_modalidad' => 'required|is_not_unique[tipo_modalidad.id]',
            'id_respaldo_digital' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }
        $post = $this->request->getPost([
            'titulo',
            'numero_folio',
            'resumen',
            'id_programa',
            'id_ciudad',
            'id_tipo_modalidad',
            'id_respaldo_digital'
        ]);

        $this->documentosModel->update($id, [
            'titulo' => $post['titulo'],
            'numero_folio' => $post['numero_folio'],
            'resumen' => $post['resumen'],
            'id_programa' => $post['id_programa'],
            'id_ciudad' => $post['id_ciudad'],
            'id_tipo_modalidad' => $post['id_tipo_modalidad'],
            'id_respaldo_digital' => $post['id_respaldo_digital'],

        ]);
        return redirect()->to('documentos');
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
            return redirect()->route('documentos');
        }
        $this->documentosModel->delete($id);
        return redirect()->to('documentos');
    }
}
