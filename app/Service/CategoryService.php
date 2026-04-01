<?php

namespace App\Service;

use App\Models\Category;

use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function categoryPaginationQuery(array $filter): LengthAwarePaginator
    {
        $query = Category::query();

        $query->when(
            isset($filter['search']) && $filter['search'] !== '',
            function ($q) use ($filter) {
                $q->where('category_name', 'ILIKE', '%' . $filter['search'] . '%');
            }
        );

        $query->withCount('recipients');

        $query->orderBy('created_at', 'asc');

        $data = $query->paginate(10);

        return $data;
    }
}
