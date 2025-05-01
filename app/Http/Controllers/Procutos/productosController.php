<?php

namespace App\Http\Controllers\Procutos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productosController extends Controller
{

    function __construct(){
        $this->middleware("can:productos.index")->only("index"); // Permiso para ver la lista de productos
        $this->middleware("can:productos.create")->only("create", "store"); // Permiso para crear productos
        $this->middleware("can:productos.edit")->only("edit", "update"); // Permiso para editar productos
        $this->middleware("can:productos.destroy")->only("destroy"); // Permiso para eliminar productos
    }
    
    public function index(){
        return view("productos.index");
    }

    public function create(){
        return view("productos.create");
    }
}
