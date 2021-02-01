<?php

namespace preventaBiox\Http\Controllers;

use Illuminate\Http\Request;

use preventaBiox\Http\Requests\BonuseRequest;

use preventaBiox\Bonuse;
use preventaBiox\Product;

class BonuseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //Validando que se el administrador
        //MIDDLEWARE
        //KERNEL
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $bonos = Bonuse::bonos();
        return view('bonuses.index', compact('bonos'));
    }

    public function create()
    {
        $productos = Product::all();
        return view('bonuses.create',compact('productos'));
    }

    public function store(BonuseRequest $request)
    {       
        //Se genera un SLUG unico y propio para el proveedor
        $slug = str_slug($request->titulo_bono.str_random(2));

        $bono = new Bonuse;
        $bono->titulo               = $request->titulo_bono;
        $bono->descripcion          = $request->descripcion_bono;
        $bono->cantidad_producto    = $request->cantidad_bono;
        $bono->products_id          = $request->productsId_bono;
        $bono->slug                 = $slug;
        $bono->save();

        return redirect(route('bonos.index'));
    }

    public function show($slug)
    {
        $bono = Bonuse::bono($slug);
        return view('bonuses.show', compact('bono'));
    }

    public function edit($slug)
    {
        $productos = Product::all();
        $bono = Bonuse::bono($slug);
        return view('bonuses.edit', compact('productos','bono'));
    }

    public function update(BonuseRequest $request)
    {
        $bono = Bonuse::find($request->id_bono);
        $bono->titulo               = $request->titulo_bono;
        $bono->descripcion          = $request->descripcion_bono;
        $bono->cantidad_producto    = $request->cantidad_bono;
        $bono->products_id          = $request->productsId_bono; 
        $bono->save();

        return redirect(route('bonos.index'));
    }

    public function destroy(Request $request, $slug)
    {
        return;
    }
}