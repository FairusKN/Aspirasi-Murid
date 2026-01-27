<?php

namespace App\Service\Feedback;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Enum\UserRole;

class AdminFeedbackService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /**
     * Return a Feedback data
     *
     * @param array $filter
     * @return Feedback
     *
     */
    public function __invoke(array $filter)
    {
        $query = Feedback::query()

            // If User is a superAdmin, User can see the anonym student
            ->when(
                Auth::user()->role === UserRole::SuperAdmin->value,
                fn($q) => $q->with('student')->when(
                    isset($filter['student_name']),
                    fn($q) => $q->whereRelation('student', 'full_name', 'ILIKE', "%" . $filter['student_name'] . '%')
                )
            )
            ->when(
                isset($filter['category']),
                fn($q) => $q->whereRelation('category', 'name', 'ILIKE', '%' . $filter['category'] . '%')
            )
            ->when(
                isset($filter['feedback_title']),
                fn($q) => $q->where('feedback_title', 'ILIKE', '%' . $filter['feedback_title'] . '%')
            )
            ->when(
                isset($filter['location']),
                fn($q) => $q->where('location', 'ILIKE', '%' . $filter['location'] . '%')
            )
            ->when(
                isset($filter['anonymous']),
                fn($q) => $q->where('anonymous', $filter['anonymous'])
            )
            ->when(
                isset($filter['status']),
                fn($q) => $q->where('status', $filter['status'])
            )
            ->when(
                isset($filter['has_image']),
                fn($q) => $q->whereNotNull('image')
            );

        $data = $query->paginate(10);

        return $data;
    }
}
