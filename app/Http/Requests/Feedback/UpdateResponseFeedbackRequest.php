<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

use App\Enum\FeedbackStatus;
use App\Enum\UserRole;
use App\Enum\Category;

class UpdateResponseFeedbackRequest extends FormRequest
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
            'category' => ['nullable', new Enum(Category::class)],
            'status' => ['nullable', new Enum(FeedbackStatus::class)],
            'admin_response' => 'nullable|string'
        ];
    }
}
