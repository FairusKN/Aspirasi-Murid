<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserRole;
use App\Enum\Category;
use Illuminate\Validation\Rules\Enum;

class RecipientFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role === UserRole::Admin->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
            'from_category' => ['nullable', new Enum(Category::class)]
        ];
    }
}
