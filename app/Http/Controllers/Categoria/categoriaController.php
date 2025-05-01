<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoriaController extends Controller
{
    public function index()
    {
        return view('categorias.index');
    }
}
