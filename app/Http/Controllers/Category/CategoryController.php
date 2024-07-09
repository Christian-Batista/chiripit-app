<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\CategoryServices\CategoryService;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;


class CategoryController extends Controller
{
    public $categoryService;


    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }   
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        $response = $this->categoryService->createCategory($request);
        return response()->json($response);
    }

    public function update(CategoryUpdateRequest $request, $categoryId): JsonResponse
    {
        $response = $this->categoryService->updateCategory($request, $categoryId);
        return response()->json($response);
    }
}
