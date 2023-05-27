<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MineType implements Rule
{
    /**
     * @var array|string
     */
    private array|string $extensions;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array|string $extensions)
    {
        $this->extensions = $extensions;
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
        if (is_array($value)) {
          foreach ($value as $extension) {
            if (! in_array($extension, ['jpg', 'jpeg', 'png'])) {
              return false;
            }
          }

          return true;
        } else {
          return in_array($value, ['jpg', 'jpeg', 'png']);
        }
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
