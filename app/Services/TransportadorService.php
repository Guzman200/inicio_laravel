<?php

namespace App\Services;

use App\Models\Transportador;

class TransportadorService{

    public function __construct(){

    }

    public function crear(Transportador $transportador){
        $transportador->save();
    }

    public function editar(array $data, $id){
        Transportador::findOrFail($id)->update($data);
    }

    public function eliminar($id){
        Transportador::findOrFail($id)->delete();
    }   

}