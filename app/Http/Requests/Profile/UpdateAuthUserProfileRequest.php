<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use App\Enums\Profile\ProfileHeight;
use App\Enums\Profile\ProfileWeight;
use App\Rules\SnsLinkRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthUserProfileRequest extends FormRequest
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
            'file_path' => ['nullable'],
            'height' => ['nullable', Rule::in(ProfileHeight::toArray())],
            'weight' => ['nullable', Rule::in(ProfileWeight::toArray())],
            'account' => ['nullable', 'string', 'max:255', new SnsLinkRule()],
            'introduction' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'file_path' => __('profile.file_path'),
            'height' => __('profile.height'),
            'weight' => __('profile.weight'),
            'account' => __('profile.account'),
            'introduction' => __('profile.introduction'),
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
     * @return string|null
     */
    public function getFilePath(): string|null
    {
        return $this->input('file_path');
    }

    /**
     * @return int|null
     */
    public function getHeight(): int|null
    {
        return $this->input('height');
    }

    /**
     * @return int|null
     */
    public function getWeight(): int|null
    {
        return $this->input('weight');
    }

    /**
     * @return string|null
     */
    public function getAccount(): string|null
    {
        return $this->input('account');
    }

    /**
     * @return string|null
     */
    public function getIntroduction(): string|null
    {
        return $this->input('introduction');
    }
}
