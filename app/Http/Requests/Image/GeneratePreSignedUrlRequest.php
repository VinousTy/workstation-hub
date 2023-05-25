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
            'extension' => ['required', 'string', new MineType($this->getExtension())],
            'type' => ['required', 'string', Rule::in(ImageType::toArray())],
        ];
    }

    /**
     * @return string
     */
    public function getParameter(): string
    {
        return $this->route()->parameter('profile_id');
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->input('extension') ?? '';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->input('type');
    }
}
