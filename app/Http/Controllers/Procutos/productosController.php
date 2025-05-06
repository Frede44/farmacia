<?php

namespace App\Http\Controllers\Procutos;

use App\Http\Controllers\Controller;
use App\Models\Productos;
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
        $productos=Productos::select('id','codigo','nombre','descripcion','precio_venta','imagen')
        ->get();

        return view("productos.index",["productos"=>$productos]);
    }

    public function create(){
        return view("productos.create");
    }
    public function store(Request $request)

            {
                
                $request->validate([
                    'codigo' => 'required|string|max:35|unique:productos,codigo',
                    'nombre' => 'required|string|max:35|unique:productos,nombre',
                    'descripcion' => 'nullable|string|max:500',
                    'precio_venta' => 'required|numeric|min:0',
                    'imagen' => 'required|image|mimes:png,jpg'
                ]);

                $file = $request->file('imagen');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagenes'), $name); // Guarda en public/imagenes

                Productos::create([
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio_venta' => $request->precio_venta,
                    'imagen' => $name,
                ]);
                
                return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
            }
    
}

