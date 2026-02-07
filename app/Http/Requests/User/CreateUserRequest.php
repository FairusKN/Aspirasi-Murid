<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserRole;
use App\Enum\UserClass;
use Illuminate\Validation\Rules\Enum;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value
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
            'email' => "required|email|unique:users,email",
            'full_name' => 'required|string',
            'password' => 'nullable|string|min:8',
            'role' => ['nullable', new Enum(UserRole::class)],
            'nis' => 'nullable|string|unique:users,nis',
            'class' => ['nullable', new Enum(UserClass::class)],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->input('role') === UserRole::Student->value || !$this->filled('role')) {
                if (!$this->filled('nis') || !$this->filled('class')) {
                    $validator->errors()->add([
                        'field',
                        __('messages.student_create_error')
                    ]);
                }
            }
        });
    }
}
