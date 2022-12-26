<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class prueba extends Controller
{
    public function index()
    {
        // $productos = Producto::paginate(10000);
        $productos = DB::table('productos')
                        ->select('id','codigo','nombre','seccion','marca','stock','imagen')
                        ->where('stock','<=', 5)
                        ->paginate(5);
        return view('productos.stock', compact('productos'));
    }
    
}
