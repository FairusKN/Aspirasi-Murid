<?php

namespace App\Service;

use App\Models\User;
use App\Models\Category;
use App\Enum\UserRole;


class CategoryRecipientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function recipientPaginationQuery(array $filter)
    {
        $query = User::query();

        $query->where('role', UserRole::Recipient->value);

        $query->when(
            isset($filter['search']) && $filter['search'] !== '',
            function ($q) use ($filter) {
                $q->where('full_name', 'ILIKE', '%' . $filter['search'] . '%');
            }
        );

        $query->when(
            isset($filter['from_category']),
            fn($q) => $q->where('from_category', $filter['from_category'])
        );

        $query->orderBy('created_at', 'asc');

        $recipients = $query->with('hasRecipient')->paginate(10);

        // Return Category cuz in the same page as create recipient

        $categories = Category::select('id', 'category_name')->get();

        return compact('recipients', 'categories');
    }
}
