<?php

declare(strict_types=1);

namespace App\Http\Requests\Image;

use App\Enums\Image\ImageType;
use App\Rules\MineType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeneratePreSignedUrlRequest extends FormRequest
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
            'extensions' => ['required', 'array', new MineType($this->getExtensions())],
            'extensions.*' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(ImageType::toArray())],
        ];
    }

    /**
     * @return string
     */
    public function getParameter(): string
    {
        return $this->route()->parameter('parent_id');
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
}
