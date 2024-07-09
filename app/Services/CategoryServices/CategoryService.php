<?php

namespace App\Services\CategoryServices;

use App\Models\Category;
use App\Http\Requests\Responses\Success;
use App\Http\Requests\Category\CategoryCreateRequest;

class CategoryService
{
    public function createCategory(CategoryCreateRequest $category): array
    {
        Category::create([
            'category_name' => $category->category_name
        ]);

        return [
            'cod' => Success::CREATED['cod'],
            'msg' => Success::CREATED['msg']
        ];
    }

    public function updateCategory($category, $categoryId): array
    {
        $categoryToUpdate = Category::findOrFail($categoryId);
        

        $categoryToUpdate->update([
            'category_name' => $category->category_name
        ]);
        return [
            'cod' => Success::UPDATED['cod'],
            'msg' => Success::UPDATED['msg'],
        ];
    }
}
