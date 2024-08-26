<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store(array $productData): Product
    {
        $product = Product::create($productData);
        if (!empty($productData['categoryEId'])) {
            $product->categories()->attach($productData['categoryEId']);
        }
        return $product;
    }

    public function update(array $productData, Product $product) : Product
    {
        $product->update($productData);
        if (!empty($productData['categoryEId'])) {
            $product->categories()->sync($productData['categoryEId']);
        }
        return $product;
    }
}
