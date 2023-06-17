<?php

declare(strict_types=1);

namespace App\Http\Requests\Notification;

use App\Enums\Common\Pagination;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FetchNotificationListRequest extends FormRequest
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
            'per_page' => ['nullable', 'integer', Rule::in(Pagination::toArray())],
            'current_page' => ['nullable', 'integer', 'max:255'],
        ];
    }

    /**
     * @return string|null
     */
    public function getPerPage(): string|null
    {
        return $this->query('per_page');
    }

    /**
     * @return string|null
     */
    public function getCurrentPage(): string
    {
        return $this->query('current_page');
    }
}
