<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function formato()
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('formato');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

        return view('formato');
    }
}
