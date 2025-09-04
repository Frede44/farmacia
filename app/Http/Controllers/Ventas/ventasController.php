<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\DetalleVentas;
use App\Models\Inventario;
use App\Models\Personas;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\IFTTTHandler;

class ventasController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:ventas.index')->only(['index']);
        $this->middleware('can:ventas.create')->only(['create', 'store']);
        $this->middleware('can:ventas.show')->only(['show']);
        $this->middleware('can:ventas.edit')->only(['edit', 'update']);
        $this->middleware('can:ventas.destroy')->only(['destroy']);
    }

    public function index()
    {
        $ventas = Ventas::with(['cliente', 'usuario'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $personas = Personas::all();


        $productosInventario = Inventario::with('producto.categoria')
            ->select('id', 'id_producto', 'xunidad', 'xcaja', 'caducidad', 'cantidad_caja', 'unidad_caja', 'total_unidad', 'id_categoria')
            ->where('estado', true) // Filtrar solo productos activos
            ->where('caducidad', '>', now()) //solo productos con fecha de caducidad futura
            ->get()
            ->map(function ($item) {
                $item->fechaCaducidadObj = new \DateTime($item->caducidad);
                $hoy = new \DateTime();
                $diff = $hoy->diff($item->fechaCaducidadObj);
                $item->diferenciaDias = (int)$diff->format('%r%a'); // días con signo (+/-)
                return $item;
            });

        return view('ventas.create', compact('personas', 'productosInventario'));
    }

    public function store(Request $request)
    {



        // Validar datos mínimos
        $request->validate([
            'id_cliente' => 'required|exists:personas,id',
            'productos' => 'required|array|min:1',
            'productos.*.nombre' => 'required|string',
            'productos.*.tipo' => 'required|string',
            'productos.*.precio' => 'required|numeric',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $usuario = Auth::user()->id;

        $total = 0;

        //validar si la cantidad de producto es mayor a la cantidad en inventario

        foreach ($request->productos as $producto) {
            $inventario = Inventario::where('id_producto', $producto['id_producto'])
            ->where('estado', true)
            ->first();



            if (!$inventario) {
                return redirect()->back()->withErrors(['error' => 'Producto no encontrado en inventario.']);
            }

            if ($producto['tipo'] === 'Unidad' && $inventario->total_unidad < $producto['cantidad']) {
                return redirect()->back()->withErrors(['error' => 'Cantidad de unidades insuficientes en inventario para el producto: ' . $producto['nombre']]);
            } elseif ($producto['tipo'] === 'Caja' && $inventario->cantidad_caja < $producto['cantidad']) {
                return redirect()->back()->withErrors(['error' => 'Cantidad de cajas insuficientes en inventario para el producto: ' . $producto['nombre']]);
            }
        }
        // Calcular total
        foreach ($request->productos as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        // Crear la venta
        $venta = Ventas::create([
            'cliente_id' => $request->id_cliente,
            'usuario_id' => $usuario,
            'fecha' => now(),
            'total' => $total,
            'estado' => true
            // Agrega otros campos si es necesario
        ]);



        foreach ($request->productos as $producto) {
            // Crear detalle de venta
            DetalleVentas::create([
                'venta_id'        => $venta->id,
                'producto_id'     => $producto['id_producto'],
                'tipo_venta'      => $producto['tipo'],
                'cantidad'        => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal'        => $producto['precio'] * $producto['cantidad'],
            ]);

            // Obtener inventario FIFO (por fecha más próxima)
            $inventarios = Inventario::where('id_producto', $producto['id_producto'])
                ->where('estado', true)
                ->orderBy('caducidad', 'asc')
                ->get();

            $cantidadRestante = $producto['cantidad'];

            foreach ($inventarios as $inv) {
                if ($producto['tipo'] === 'Unidad') {
                    $unidadCaja = $inv->unidad_caja;

                    if ($inv->total_unidad >= $cantidadRestante) {
                        // Restar la cantidad vendida
                        $inv->total_unidad -= $cantidadRestante;

                        // Recalcular la cantidad de cajas disponibles según el total de unidades restantes
                        $inv->cantidad_caja = intdiv($inv->total_unidad, $unidadCaja);

                        $inv->save();
                        $cantidadRestante = 0;
                    } else {
                        
                        $cantidadVendidaDesdeEsteLote = $inv->total_unidad;

                        $inv->total_unidad = 0;
                        $inv->cantidad_caja = 0;

                        $inv->save();

                        $cantidadRestante -= $cantidadVendidaDesdeEsteLote;
                    }
                } elseif ($producto['tipo'] === 'Caja') {
                    if ($inv->cantidad_caja >= $cantidadRestante) {
                        $inv->cantidad_caja -= $cantidadRestante;
                        $inv->total_unidad -= ($cantidadRestante * $inv->unidad_caja);
                        $inv->save();
                        $cantidadRestante = 0;
                    } else {
                        $cajasDisponibles = $inv->cantidad_caja;
                        $inv->cantidad_caja = 0;
                        $inv->total_unidad -= ($cajasDisponibles * $inv->unidad_caja);
                        $inv->save();
                        $cantidadRestante -= $cajasDisponibles;
                    }
                }

                // Eliminar el registro si ya no tiene unidades
                if ($inv->total_unidad <= 0 && $inv->cantidad_caja <= 0) {
                    $inv->delete();
                }

                if ($cantidadRestante <= 0) break;
            }
        }

        // Obtener detalles de la venta
        $ventasDetalles = DetalleVentas::where('venta_id', $venta->id)->with(['producto'])->get();

        //generar ticket de venta en PDF

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('exports.ticket_pdf', ['venta' => $venta, 'ventasDetalles' => $ventasDetalles]);
        $nombreArchivo = 'ticket_venta_' . $venta->id . '.pdf';
        $pdf->save(public_path('tickets/' . $nombreArchivo));



        return redirect()->route('ventas.index')->with([
            'success' => 'Venta creada con éxito.',
            'pdf' => asset('tickets/' . $nombreArchivo)
        ]);
    }

    public function show($id)
    {

        $detalles = DetalleVentas::where('venta_id', $id)->with(['producto'])->get();
        return view('ventas.show', compact('detalles'));
    }

    public function edit($id)
    {
        return view('ventas.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the sale
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    public function destroy($id)
    {
        // Logic to delete the sale
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
