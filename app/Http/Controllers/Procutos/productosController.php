<?php

namespace App\Http\Controllers\Procutos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productosController extends Controller
{
    public function index(){
        return view("productos.index");
    }
}
