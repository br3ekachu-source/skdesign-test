<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function store(array $categoryData): Category
    {
        $category = Category::create($categoryData);
        return $category;
    }

    public function update(array $categoryData, Category $category) : Category
    {
        $category->update($categoryData);
        return $category;
    }
}
