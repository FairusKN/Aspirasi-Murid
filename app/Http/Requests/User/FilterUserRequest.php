<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserRole;

class FilterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [
            UserRole::Admin->value,
            UserRole::SuperAdmin->value
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'nullable|string|max:30',
            'full_name' => 'nullable|string|max:30',
            'nis' => 'nullable|string|max:30',
            'class' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
            'role' => 'nullable|string'
        ];
    }
}
