<?php

namespace App\Rules\Transportador;

use App\Models\Transportador;
use Illuminate\Contracts\Validation\Rule;

class UpdatePhoneRule implements Rule
{

    public $transportador_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($transportador_id)
    {
        $this->transportador_id = $transportador_id;
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

        $transportador = Transportador::findOrFail($this->transportador_id);

        $telefono = Transportador::where('telefono',$value)->where('telefono', '<>', $transportador->telefono)->first();  
        
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
