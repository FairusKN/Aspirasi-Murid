<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function create(CreateCategoryRequest $request)
    {
        return back()->with(Category::create($request->validated()));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return back()->with($category->update($request->validated));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('pages.dashboard');
    }
}
