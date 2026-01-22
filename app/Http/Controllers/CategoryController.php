<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function create(CreateCategoryRequest $request)
    {
        Category::create($request->validated());
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.category')
                ]
            )
        );
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return back()->with(
            "success",
            __(
                'messages.updated',
                [
                    'attribute' => __('models.category')
                ]
            )
        );
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('pages.dashboard')->with(
            "success",
            __(
                'messages.deleted',
                [
                    'attribute' => __('models.category')
                ]
            )
        );
    }
}
