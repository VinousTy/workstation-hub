<?php

declare(strict_types=1);

namespace App\Http\Requests\Desk;

use App\Enums\Image\ImageType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'files' => ['required', 'array'],
            'extensions' => ['required', 'array'],
            'extensions.*' => ['required', 'string'],
            'type' => ['required', Rule::in(ImageType::toArray())],
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
            'files' => __('desk_image.files'),
            'description' => __('desk.description'),
            'category_name' => __('category.name'),
        ];
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->file('files');
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return $this->input('extensions');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->input('type');
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
