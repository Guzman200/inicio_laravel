<?php

namespace App\Rules\Usuario;

use Illuminate\Contracts\Validation\Rule;

class UsuarioStoreRule implements Rule
{

    private $usuario_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $usuario_id)
    {
        $this->usuario_id = $usuario_id;
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
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
