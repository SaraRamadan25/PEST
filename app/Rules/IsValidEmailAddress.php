<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;

class IsValidEmailAddress implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException('The value must be a string!');
        }

        return preg_match_all('/^\S+@\S+\.\S+$/', $value) > 0;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The given email address is invalid.';
    }
}

