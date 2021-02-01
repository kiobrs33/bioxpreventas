<?php

namespace preventaBiox\Http\Controllers;

use Illuminate\Http\Request;

use preventaBiox\Http\Requests\ProductRequest;

use preventaBiox\Product;

class ProductController extends Controller
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
        $productos = Product::orderBy('id', 'DESC')->paginate(10);
        return view('products.index', compact('productos'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        //Se genera un SLUG unico y propio para el proveedor
        $slug = str_slug($request->nombre_producto . str_random(2));

        $producto = new Product;
        $producto->nombre           = $request->nombre_producto;
        $producto->descripcion      = $request->descripcion_producto;
        $producto->cantidad_paquete = $request->cant_paquete_producto;
        $producto->precio           = $request->precio_producto;
        $producto->slug             = $slug;
        $producto->save();

        return redirect(route('productos.index'));
    }

    public function show($slug)
    {
        $producto = Product::where('slug', $slug)->first();
        return view('products.show', compact('producto'));
    }

    public function edit($slug)
    {
        $producto = Product::where('slug', $slug)->first();
        return view('products.edit', compact('producto'));
    }

    public function update(ProductRequest $request)
    {
        $producto = Product::find($request->id_producto);
        $producto->nombre           = $request->nombre_producto;
        $producto->descripcion      = $request->descripcion_producto;
        $producto->cantidad_paquete = $request->cant_paquete_producto;
        $producto->precio           = $request->precio_producto;
        $producto->save();

        return redirect(route('productos.index'));
    }

    public function destroy(Request $request, $slug)
    {

        return;
    }
}
