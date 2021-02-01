<?php

namespace preventaBiox\Http\Controllers\Employee;

use Illuminate\Http\Request;

//importando clase CONTROLLER
use preventaBiox\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('homeEmployee');
    }
}