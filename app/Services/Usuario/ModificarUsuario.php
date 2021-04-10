<?php

namespace App\Services\Usuario;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ModificarUsuario {

    private $id;
    private $nombres;
    private $ap_paterno;
    private $ap_materno;
    private $nombre_usuario;
    private $telefono;
    private $email;
    private $password;

    public function __construct(
        $id,
        $nombres, 
        $ap_paterno, 
        $ap_materno, 
        $nombre_usuario, 
        $telefono=NULL, 
        $email, 
        $password
    )
    {
        $this->id             = $id;
        $this->nombres        = $nombres;
        $this->ap_paterno     = $ap_paterno;
        $this->ap_materno     = $ap_materno;
        $this->nombre_usuario = $nombre_usuario;
        $this->telefono       = $telefono;
        $this->email          = $email;
        $this->password       = $password;
    }

    public function modificar(){

        $userModificar = User::findOrFail($this->id)
            ->update([
                'nombre_usuario'       => $this->nombre_usuario,
                'nombres'              => $this->nombres,
                'ap_paterno'           => $this->ap_paterno,
                'ap_materno'           => $this->ap_materno,
                'telefono'             => $this->telefono,
                'email'                => $this->email,
                'password'             => Hash::make($this->password)
            ]);

        return $userModificar;

        if ($this->modificoPassword()) {
            $userModificar->password =  Hash::make($this->password);
        }

        $userModificar->update();
    }

    private function modificoPassword()
    {
        return $this->password != "" && $this->password !=  NULL ? true : false;
    }


}