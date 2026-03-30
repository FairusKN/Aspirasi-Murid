<?php

namespace App\Service;

use App\Models\CategoryRecipient;


use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRecipientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function recipientPaginationQuery(array $filter): LengthAwarePaginator
    {
        $query = CategoryRecipient::query();

        $query->when(
            isset($filter['search']) && $filter['search'] !== '',
            function ($q) use ($filter) {
                $q->where('full_name', 'ILIKE', '%' . $filter['search'] . '%');
            }
        );

        $query->when(
            isset($filter['is_active']),
            fn($q) => $q->where('is_active', $filter['is_active'])
        );

        $query->when(
            isset($filter['from_category']),
            fn($q) => $q->where('from_category', $filter['from_category'])
        );

        $query->orderBy('created_at', 'asc');

        $data = $query->paginate(10);

        return $data;
    }

    public function activateToggle(CategoryRecipient $userToChange): bool
    {
        $userToChange->update([
            // If is_active is true, then it will become false
            // Else it will become True
            'is_active' => $userToChange->is_active ? false : true
        ]);

        return $userToChange->fresh()->is_active;
    }
}
