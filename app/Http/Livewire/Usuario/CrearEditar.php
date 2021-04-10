<?php

namespace App\Http\Livewire\Usuario;

use App\Services\Usuario\CrearUsuario;
use App\Services\Usuario\ModificarUsuario;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CrearEditar extends Component
{

    public $usuario_id;
    public $nombres;
    public $ap_paterno;
    public $ap_materno;
    public $telefono;
    public $email;
    public $nombre_usuario;
    public $password;
    public $password_confirmation;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate', 'cambiarStatus'];

    protected $rules = [
        'nombre_usuario'       => 'required|min:5',
        'nombres'              => 'required',
        'ap_paterno'           => 'required',
        'ap_materno'           => 'required',
        'telefono'             => ['nullable', 'regex:/^[0-9]{10}$/'],
        'email'                => 'required|email',
    ];

    protected $messages = [
        'telefono.regex'                => 'El teléfono debe contener 10 digitos',
    ];

    protected $validationAttributes = [
        'nombre_usuario' => 'usuario',
        'ap_paterno'     => 'apellido paterno',
        'ap_materno'     => 'apellido materno',
        'telefono'       => 'teléfono',
        'password'       => 'contraseña'
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

            $this->validarAgregarUsuario();

            $this->crearUsuario();

            $this->limpiarDatos();
        } else {

            $this->validarModificarUsuario();

            $this->modificarUsuario();

            $mensaje = "Usuario actualizado exitosamente.";
        }

        session()->flash('message', $mensaje);

        $this->emit('actualizar_tabla');
    }

    public function crearUsuario()
    {

        $crearUsuario = new CrearUsuario(
            $this->nombres,
            $this->ap_paterno,
            $this->ap_materno,
            $this->nombre_usuario,
            $this->telefono,
            $this->email,
            false,
            $this->password
        );

        $crearUsuario->crear();
    }

    public function modificarUsuario()
    {

        $modificarUsuario = new ModificarUsuario(
            $this->usuario_id,
            $this->nombres,
            $this->ap_paterno,
            $this->ap_materno,
            $this->nombre_usuario,
            $this->telefono,
            $this->email,
            $this->password
        );

        $modificarUsuario->modificar();

    }

    public function validarAgregarUsuario()
    {
        $this->validate([
            'password'       => 'required|min:5|confirmed',
            'nombre_usuario' => 'unique:users',
            'email'          => 'unique:users',
            'telefono'       => 'sometimes|unique:users'
        ]);
    }

    public function validarModificarUsuario()
    {
        $this->validate([
            'nombre_usuario' => Rule::unique('users')->ignore($this->usuario_id),
            'email'          => Rule::unique('users')->ignore($this->usuario_id),
            'telefono'       => ['sometimes', Rule::unique('users')->ignore($this->usuario_id)]
        ]);

        if ($this->modificoPassword()) {
            $this->validate([
                'password' => 'required|min:5|confirmed',
            ]);
        }
    }

    public function modificoPassword()
    {
        return $this->password != "" && $this->password !=  NULL ? true : false;
    }

    public function limpiarDatos()
    {
        $this->nombres               = "";
        $this->nombre_usuario        = "";
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

        $this->limpiarDatos();

        // Si el usuario existe
        if ($usuario) {

            $this->usuario_id         = $id;
            $this->nombres            = $usuario->nombres;
            $this->nombre_usuario     = $usuario->nombre_usuario;
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
