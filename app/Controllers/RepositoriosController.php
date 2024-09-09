<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RepositoriosController extends BaseController
{
    public function index()
    {
        return view('repositorios/index');
    }

    public function programas()
    {
        return view('repositorios/programas');
    }
}
