<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function createCategory(CreateCategoryRequest $request)
    {
        return back()->with(Category::create($request->validated()));
    }

    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        return back()->with($category->update($request->validated));
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('page.dashboard');
    }
}
