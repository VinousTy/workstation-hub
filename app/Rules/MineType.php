<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MineType implements Rule
{
    /**
     * @var string
     */
    private string $extension;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($this->extension, ['jpg', 'jpeg', 'png']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return ':attributeはにはjpg, jpeg, pngタイプのファイルを指定してください。';
    }
}
