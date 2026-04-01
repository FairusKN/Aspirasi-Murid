<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

use App\Enum\UserRole;
use Illuminate\Validation\Rules\Enum;
use App\Enum\FeedbackStatus;

class AdminFilterFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [UserRole::Admin->value, UserRole::SuperAdmin->value, UserRole::Recipient->value]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_name' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:50',
            'feedback_title' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:50',
            'anonymous' => 'nullable|boolean',
            'status' => ['nullable', new Enum(FeedbackStatus::class)],
            'has_image' => 'nullable|boolean'
        ];
    }
}
