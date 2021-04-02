<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CrearEditar extends Component
{

    public $usuario_id;
    public $num_identificacion;
    public $nombres;
    public $ap_paterno;
    public $ap_materno;
    public $telefono;
    public $email;
    public $password;
    public $password_confirmation;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate', 'cambiarStatus'];

    protected $rules = [
        'num_identificacion'   => 'required',
        'nombres'              => 'required',
        'ap_paterno'           => 'required',
        'ap_materno'           => 'required',
        'telefono'             => 'nullable',
        'email'                => 'required|email',
    ];

    protected $messages = [
        'num_identificacion.required'   => 'Es requerido',
        'nombres.required'              => 'Es requerido',
        'ap_paterno.required'           => 'Es requerido',
        'ap_materno.required'           => 'Es requerido',
        'telefono.required'             => 'Es requerido',
        'email.required'                => 'Es requerido'
    ];

    public function render()
    {
        return view('livewire.usuario.crear-editar');
    }

    public function storeUpdate()
    {


        $this->validate($this->rules, $this->messages);

        $mensaje = "Usuario creado exitosamente.";

        if (is_null($this->usuario_id)) {

            $this->validate([
                'password' => 'required|min:5|confirmed',
            ], ['password.confirmed' => 'Las contraseñas no coinciden.']);

            User::create([
                'num_identificacion'   => $this->num_identificacion,
                'nombres'              => $this->nombres,
                'ap_paterno'           => $this->ap_paterno,
                'ap_materno'           => $this->ap_materno,
                'telefono'             => $this->telefono,
                'email'                => $this->email,
                'password'             => Hash::make($this->password)
            ]);


            $this->limpiarDatos();
        } else {
            // Actualizamos
            $usuario = User::findOrFail($this->usuario_id);
            $usuario->num_identificacion = $this->num_identificacion;
            $usuario->nombres            = $this->nombres;
            $usuario->ap_paterno         = $this->ap_paterno;
            $usuario->ap_materno         = $this->ap_materno;
            $usuario->telefono           = $this->telefono;
            $usuario->email              = $this->email;
            $usuario->update();
            $mensaje = "Usuario actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function limpiarDatos()
    {
        $this->num_identificacion    = "";
        $this->nombres               = "";
        $this->ap_paterno            = "";
        $this->ap_materno            = "";
        $this->telefono              = "";
        $this->email                 = "";
        $this->password              = "";
        $this->password_confirmation = "";
    }

    public function editar($id)
    {
        $usuario = User::find($id);

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        // Si el usuario existe
        if ($usuario) {

            $this->usuario_id         = $id;
            $this->num_identificacion = $usuario->num_identificacion;
            $this->nombres            = $usuario->nombres;
            $this->ap_paterno         = $usuario->ap_paterno;
            $this->ap_materno         = $usuario->ap_materno;
            $this->telefono           = $usuario->telefono;
            $this->email              = $usuario->email;

            $this->emit('abrirModal');
        }
    }

    public function agregar()
    {
        $this->usuario_id = null;
        $this->limpiarDatos();

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function eliminar($id)
    {
        $usuario = User::find($id);

        // Si el usuario existe
        if ($usuario) {


            try {

                $usuario->delete();
                $this->emit('actualizar_tabla');
                $this->emit('sweetAlert', 'Eliminación exitosa.', '', 'success');
                
            } catch (Exception $e) {
                $this->emit('sweetAlert', 'Usuario no eliminado', '', 'error');
            }
        }
    }

    public function cambiarStatus($id)
    {

        $usuario = User::find($id);

        // Si el usuario existe
        if ($usuario) {

            $usuario->status = !$usuario->status;
            $usuario->update();
            $this->emit('actualizar_tabla');
            $this->emit('sweetAlert', 'Actualización exitosa.', '', 'success');
        }
    }
}
