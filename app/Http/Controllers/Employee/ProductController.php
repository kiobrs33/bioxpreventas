<?php

namespace preventaBiox\Http\Controllers\Employee;

use Illuminate\Http\Request;

//importando clase CONTROLLER
use preventaBiox\Http\Controllers\Controller;

use preventaBiox\Http\Requests\ProductRequest;

use preventaBiox\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Product::orderBy('id','DESC')->paginate(10);
        return view('trabajador.products.index', compact('productos'));
    }

    public function show($slug)
    {
        $producto = Product::where('slug',$slug)->first();
        return view('trabajador.products.show', compact('producto'));
    }
}