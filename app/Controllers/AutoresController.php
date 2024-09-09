<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AutoresController extends BaseController
{
    public function index()
    {
        return view('autores/autor');
    }
    public function posgraduante()
    {
        return view('autores/posgraduantes');
    }
}
