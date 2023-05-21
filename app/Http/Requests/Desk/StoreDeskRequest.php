<?php

declare(strict_types=1);

namespace App\Http\Requests\Desk;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeskRequest extends FormRequest
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
            'description' => ['nullable', 'string', 'max:1000'],
            'category_name' => ['required', 'array'],
            'categpoy_name.*' => ['string', 'required'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'category_name' => __('category.name'),
        ];
    }

    /**
     * @return string|null
     */
    public function getDescription(): string|null
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getCategoryNames(): array
    {
        return $this->category_name;
    }
}
