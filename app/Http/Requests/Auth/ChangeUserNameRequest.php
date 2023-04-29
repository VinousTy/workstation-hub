<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserNameRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('user.name'),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }
}
