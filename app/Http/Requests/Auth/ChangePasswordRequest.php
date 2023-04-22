<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\AlphaNumSymbol;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', 'string', 'min:8', 'max:255', new AlphaNumSymbol(), Password::default()],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'password' => __('user.password'),
        ];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->input('password');
    }
}
