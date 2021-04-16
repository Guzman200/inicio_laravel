<?php

namespace App\Services\OrdenCompra;

use App\Models\OrdenCompra;
use Illuminate\Support\Facades\Hash;

class Crear {

    private $num_pagos;
    private $num_facturas;
    private $centro_costo;
    private $cotizacion;
    private $proyecto;
    private $total;
    private $total_neto;
    private $subtotal;
    private $descuento;
    private $iva_id;
    private $proveedor_id;
    private $user_id;

    public function __construct(
        /*
        $num_pagos;
        $num_facturas;
        $centro_costo;
        $cotizacion;
        $proyecto;
        $total;
        $total_neto;
        $subtotal;
        $descuento;
        $iva_id;
        $proveedor_id;
        $user_id;
        */
    )
    {
        /*
        $this->nombres        = $nombres;
        $this->ap_paterno     = $ap_paterno;
        $this->ap_materno     = $ap_materno;
        $this->nombre_usuario = $nombre_usuario;
        $this->telefono       = $telefono;
        $this->email          = $email;
        $this->status         = $status;
        $this->password       = $password;
        */
    }

    public function crear(){
        /*
        $userCreado = User::create([
            'nombre_usuario'       => $this->nombre_usuario,
            'nombres'              => $this->nombres,
            'ap_paterno'           => $this->ap_paterno,
            'ap_materno'           => $this->ap_materno,
            'telefono'             => $this->telefono,
            'email'                => $this->email,
            'status'               => $this->status,
            'password'             => Hash::make($this->password)
        ]);

        return $userCreado;
        */
    }

    /**
     * @param int $num_datos
     */
    public function prueba(int $num_datos){
        $data = [];

        $i = 0;
        while($i < $num_datos){
            $data[] = $i;
            $i++;
        }

        return $data;
    }


}