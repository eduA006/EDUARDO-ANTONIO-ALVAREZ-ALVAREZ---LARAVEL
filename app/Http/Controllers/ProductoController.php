<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
   
    //  LISTAR PRODUCTOS
  
    public function index(Request $request)
    {
        // Obtener categorías (para el filtro)
        $categorias = Categoria::all();

        // Capturar valores de búsqueda
        $buscar = $request->input('buscar');
        $categoria_id = $request->input('categoria_id');

        // Consulta base
        $query = Producto::query();

        // Filtro por nombre
        if ($buscar) {
            $query->where('nombre', 'like', "%$buscar%");
        }

        // Filtro por categoría
        if ($categoria_id) {
            $query->where('categoria_id', $categoria_id);
        }

        // Obtener resultados
        $productos = $query->get();

        return view('productos.index', compact('productos', 'categorias', 'buscar', 'categoria_id'));
    }

  
    // creaar producto
    
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    
    // guardar producto
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'codigo_barras' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'activo' => 'boolean'
        ]);

        // guardar imagen 
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes', 'public');
        } else {
            $rutaImagen = null;
        }

        // Crear producto
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'codigo_barras' => $request->codigo_barras,
            'imagen' => $rutaImagen,
            'activo' => $request->activo ?? true,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    
    // editar producto
   
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

   
    //  actualizar producto
   
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'codigo_barras' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'activo' => 'boolean'
        ]);

        // Si se sube nueva imagen, eliminar la anterior
        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $rutaImagen = $request->file('imagen')->store('imagenes', 'public');
        } else {
            $rutaImagen = $producto->imagen;
        }

        // Actualizar producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'codigo_barras' => $request->codigo_barras,
            'imagen' => $rutaImagen,
            'activo' => $request->activo ?? true,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    
    // eliminar producto
    
    public function destroy(Producto $producto)
    {
        // Eliminar imagen si existe
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    
    // dashboard 
    
    public function dashboard()
    {
        $totalProductos = Producto::count();
        $activos = Producto::where('activo', true)->count();
        $inactivos = Producto::where('activo', false)->count();
        $stockBajo = Producto::where('stock', '<', 5)->count();
        $valorTotal = Producto::sum(DB::raw('precio * stock'));

        return view('productos.dashboard', compact(
            'totalProductos',
            'activos',
            'inactivos',
            'stockBajo',
            'valorTotal'
        ));
    }
}
