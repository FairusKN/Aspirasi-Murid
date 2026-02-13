<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserRole;
use App\Enum\Category;
use Illuminate\Validation\Rules\Enum;

class CreateFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role === UserRole::Student->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'feedback_title' => "required|string",
            'category' => ['required', new Enum(Category::class)],
            'details' => 'required|string|max:255',
            'location' => 'required|string',
            //'anonymous' => 'nullable|bool',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp|max:5120'
        ];
    }
}
