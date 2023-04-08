<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\AlphaNumSymbol;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
      return [
        'email' => ['required', 'string', 'email:strict,dns,spoof', 'max:255', new AlphaNumSymbol()],
        'password' => ['required', 'string', 'min:8', 'max:255', new AlphaNumSymbol(), Password::default()],
      ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('user.email'),
            'password' => __('user.password'),
        ];
    }
}
