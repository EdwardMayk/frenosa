<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $productos = Producto::paginate(5);
        // $texto = trim($request->get('texto'));
        // $productos = DB::table('productos')
        //                 ->select('id','codigo','nombre','seccion','marca','stock','imagen')
        //                 ->where('codigo','LIKE','%'.$texto. '%')
        //                 ->orWhere('nombre','LIKE','%'.$texto. '%')
        //                 ->orWhere('marca','LIKE','%'.$texto. '%')
        //                 ->paginate(5);
        // return view('productos.index', compact('productos','texto'));

        return view('productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('productos.crear');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required','nombre' => 'required','seccion' => 'required','marca' => 'required','stock' => 'required','imagen' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:1024'
        ]);
        $producto = $request->all();
        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";    
        }
        Producto::create($producto);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.editar', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'codigo' => 'required','nombre' => 'required','seccion' => 'required','marca' => 'required','stock' => 'required'
        ]);
        $prod = $request->all();
        if($imagen = $request->file('imagen'))
        {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen'] = "$imagenProducto";
        }else{
            unset($prod['imagen']);
        }
        $producto->update($prod);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
