<?php

namespace App\Http\Controllers;

use App\Models\Transportador;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransportadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
           
            return datatables()->eloquent(Transportador::query())->toJson();
        }

        return view('transportadores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'mensaje' => 'registro exitoso'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transportador  $transportador
     * @return \Illuminate\Http\Response
     */
    public function show(Transportador $transportador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transportador  $transportador
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportador $transportador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transportador  $transportador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportador $transportador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transportador  $transportador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transportador $transportador)
    {
        //
    }
}
