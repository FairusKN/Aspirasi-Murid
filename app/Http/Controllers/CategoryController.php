<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;
use App\Http\Requests\Category\CreateUpdateCategory;
use App\Service\CategoryService;
use App\Models\User;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected CategoryService $category_service) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fields = [
            'search' => $request->get('search')
        ];
        return view('web.admin.category')
            ->with('data', $this->category_service->categoryPaginationQuery($fields));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(CreateUpdateCategory $request)
    {
        $fields = $request->validated();
        Category::create($fields);

        return back()->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return back()->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateUpdateCategory $request, Category $category)
    {
        $fields = $request->validated();
        $category->update($fields);

        return back()->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return back()->with('success');
    }
}
