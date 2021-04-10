<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $usuarios = User::select([
                'id', 'nombres', 'ap_paterno', 'ap_materno', 'telefono', 'email', 'status',
                DB::raw("CONCAT(users.nombres,' ',users.ap_paterno,' ',users.ap_materno) as full_name")
            ]);

            return datatables()->eloquent($usuarios)
                ->filterColumn('full_name', function ($query, $keyword) {
                    $sql = "CONCAT(users.nombres,' ',users.ap_paterno,' ',users.ap_materno) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->editColumn('status', function(User $user){
                    if($user->estaActivo()){
                        return "<span class='badge badge-success'>Activo</span>";
                    }
                    return "<span class='badge badge-danger'>Inactivo</span>";
                })
                ->rawColumns(['status'])
                ->toJson();
        }

        return view('usuarios');
    }
}
