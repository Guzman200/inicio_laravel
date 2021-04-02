<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    

    public function index(Request $request){

        if($request->ajax()){

            $materiales = Material::with('categoria');
           
            return datatables()->eloquent($materiales)->toJson();
        }

        return view('materiales');
    }

}
