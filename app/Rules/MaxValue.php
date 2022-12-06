<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxValue implements Rule
{
    public float $count;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(float $count)
    {
        $this->count = $count;
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
        return $this->count + $value <= 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El alumno sobrepasó los creditos permitidos por actividad, ajuste el valor o actualice la actividad. Creditos Actuales: '.$this->count;
    }
}
