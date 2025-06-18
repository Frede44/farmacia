<?php

namespace App\Http\Controllers\Procutos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Inventario;
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
        $productos=Productos::with('categoria:id,nombre') // Cargar la relación con la categoría
        ->select('id','codigo','nombre','descripcion','imagen','categoria_id')
        ->get();

        return view("productos.index",["productos"=>$productos]);
    }

    public function create() {
        $categorias = Categoria::all(['id', 'nombre']);
    
        // Obtener último código
        $ultimoProducto = Productos::latest('id')->first();
    
        if ($ultimoProducto && preg_match('/MED(\d+)/', $ultimoProducto->codigo, $coincidencias)) {
            $numero = intval($coincidencias[1]) + 1;
            $nuevoCodigo = 'MED' . str_pad($numero, 4, '0', STR_PAD_LEFT);
        } else {
            $nuevoCodigo = 'MED0001'; // Primer código si no hay productos aún
        }
    
        return view('productos.create', compact('categorias', 'nuevoCodigo'));
    }


    public function store(Request $request)
    {
        $request->validate([
            
            'nombre' => 'required|string|max:50',
            'descripcion' => 'nullable|string|max:250',
           'imagen' => 'required|image|mimes:png,jpg,jpeg,webp',
            'categoria_id' => 'required|exists:categoria,id', 
        ]);

        // Generar el código automáticamente aquí también por seguridad
        $ultimoProducto = Productos::latest('id')->first();
        if ($ultimoProducto && preg_match('/MED(\d+)/', $ultimoProducto->codigo, $coincidencias)) {
            $numero = intval($coincidencias[1]) + 1;
            $codigo = 'MED' . str_pad($numero, 4, '0', STR_PAD_LEFT);
        } else {
            $codigo = 'MED0001';
        }

        // Guardar imagen
        $file = $request->file('imagen');
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('imagenes'), $name);

        Productos::create([
            'codigo' => $codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $name,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('productos.index')->with('success', '¡Producto guardado correctamente!');
    }

    
            public function edit(Productos $producto)
            {
                $categorias = Categoria::all(['id', 'nombre']);
                return view('productos.edit', compact('producto', 'categorias'));    
            }

   
            public function update(Request $request, Productos $producto)
            {
                $request->validate([
                    'codigo' => 'required|string|max:35|unique:productos,codigo,' . $producto->id,
                    'nombre' => 'required|string|max:50' . $producto->id,
                    'descripcion' => 'nullable|string|max:250',
                    'imagen' => 'required|image|mimes:png,jpg,jpeg,webp',
                    'categoria_id' => 'required|exists:categoria,id', 
                ]);
            
                // Si hay imagen nueva
                if ($request->hasFile('imagen')) {
                    // Eliminar imagen anterior si existe
                    if ($producto->imagen && file_exists(public_path('imagenes/' . $producto->imagen))) {
                        unlink(public_path('imagenes/' . $producto->imagen));
                    }
            
                    // Guardar la nueva imagen
                    $file = $request->file('imagen');
                    $name = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('imagenes'), $name);
                    $producto->imagen = $name;
                }
            
                // Actualiza otros campos
                $producto->update([
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'categoria_id' => $request->categoria_id,
                    'imagen' => $producto->imagen, // ya actualizada arriba si es necesario
                ]);
            
                return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
            }
            public function destroy(Productos $producto)
            {
                // Eliminar imagen del producto si existe
                if ($producto->imagen && file_exists(public_path('imagenes/' . $producto->imagen))) {
                    unlink(public_path('imagenes/' . $producto->imagen));
                }
                //Eliminar el producto de la base de datos
                $producto->delete();
            
                return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');

        
            }  
            public function buscar(Request $request)
{
    $termino = $request->input('q');

    $producto = Productos::where('nombre', 'LIKE', "%{$termino}%")
        ->select('id', 'nombre')
        ->limit(10)
        ->get();

    return response()->json($producto);
}

                


}