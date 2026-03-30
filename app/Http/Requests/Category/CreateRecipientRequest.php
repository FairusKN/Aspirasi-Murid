<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserRole;
use App\Enum\Category;
use Illuminate\Validation\Rules\Enum;

class CreateRecipientRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],

            'from_category' => [
                'required',
                new Enum(Category::class)
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:category_recipients,email',
            ],

            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
