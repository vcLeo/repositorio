<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DocumentosController extends BaseController
{
    public function index()
    {
        return view('documentos/index');
    }
    public function publicar()
    {
        return view('documentos/publicar');
    }
    public function versiones()
    {
        return view('documentos/versiones');
    }
    public function autor()
    {
        return view('documentos/autor');
    }
}
