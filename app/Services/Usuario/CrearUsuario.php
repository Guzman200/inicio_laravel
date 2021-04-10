<?php

namespace App\Services\Usuario;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CrearUsuario {

    private $nombres;
    private $ap_paterno;
    private $ap_materno;
    private $nombre_usuario;
    private $telefono;
    private $email;
    private $status;
    private $password;

    public function __construct(
        $nombres, 
        $ap_paterno, 
        $ap_materno, 
        $nombre_usuario, 
        $telefono=NULL, 
        $email, 
        $status=false, 
        $password)
    {
        $this->nombres        = $nombres;
        $this->ap_paterno     = $ap_paterno;
        $this->ap_materno     = $ap_materno;
        $this->nombre_usuario = $nombre_usuario;
        $this->telefono       = $telefono;
        $this->email          = $email;
        $this->status         = $status;
        $this->password       = $password;
    }

    public function crear(){

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
    }


}