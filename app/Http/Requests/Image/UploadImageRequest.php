<?php

declare(strict_types=1);

namespace App\Http\Requests\Image;

use App\Enums\Image\ImageType;
use App\Rules\MineType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadImageRequest extends FormRequest
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
            'extension' => ['required', 'string', new MineType($this->getExtension())],
            'hash_file_name' => ['required', 'string', 'max:255'],
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
        return $this->input('extension');
    }

    /**
     * @return string
     */
    public function getHashFileName(): string
    {
        return $this->input('hash_file_name');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->input('type');
    }
}
