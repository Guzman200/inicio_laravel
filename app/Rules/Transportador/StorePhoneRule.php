<?php

namespace App\Rules\Transportador;

use App\Models\Transportador;
use Illuminate\Contracts\Validation\Rule;

class StorePhoneRule implements Rule
{

    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
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
        
        $telefono = Transportador::where('telefono',$value)->first();

        // Si el télefono ya existe
        if($telefono){
            return false;
        }

        return true;    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El teléfono ingresado ya se encuentra en uso.';
    }
}
