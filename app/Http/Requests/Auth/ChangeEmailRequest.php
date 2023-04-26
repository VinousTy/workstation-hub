<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\AlphaNumSymbol;
use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
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
     * 入力されたメールアドレスが有効な形式であり、ドメインが有効であり、スプーフィングされたものでないかを確認
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email:strict,dns,spoof', 'max:255', new AlphaNumSymbol()],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => __('user.email'),
        ];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }
}
