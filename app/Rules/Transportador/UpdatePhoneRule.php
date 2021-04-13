<?php

namespace App\Rules\Transportador;

use App\Models\Proveedor;
use Illuminate\Contracts\Validation\Rule;

class UpdatePhoneRule implements Rule
{

    public $proveedor_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($proveedor_id)
    {
        $this->proveedor_id = $proveedor_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** Determina si el teléfono ya existe ignorando el número de teléfono actual (antes de editar) */

        $proveedor = Proveedor::findOrFail($this->proveedor_id);

        $telefono = Proveedor::where('telefono',$value)->where('telefono', '<>', $proveedor->telefono)->first();  
        
        return $telefono ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El número de teléfono ya se encuentra en uso.';
    }
}
