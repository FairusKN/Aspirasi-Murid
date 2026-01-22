<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function create(CreateCategoryRequest $request)
    {
        // return the create data from req
        return back()->with(Category::create($request->validated()));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // return the updated data from req
        return back()->with($category->update($request->validated));
    }

    public function destroy(Category $category)
    {
        // delete the data then return to dashboard
        $category->delete();
        return redirect()->route('pages.dashboard');
    }
}
