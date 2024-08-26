<?php

namespace App\Console\Commands;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

class ReadFiles extends Command
{
    public function __construct(private ProductService $productService, private CategoryService $categoryService)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:read-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories_json = Storage::json('categories.json');
        $products_json = Storage::json('products.json');
        if ($categories_json != null) {
            foreach ($categories_json as $category_json){
                if (isset($category_json['id']) && $category = Category::find($category_json['id'] != null)) {
                    try {
                        $request = new UpdateCategoryRequest($category_json);
                        $request
                        ->setContainer(app())
                        ->setRedirector(app(Redirector::class))
                        ->validateResolved();
                        $this->categoryService->update($request->validated(), $category);
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                } else {
                    try {
                        $request = new StoreCategoryRequest($category_json);
                        $request
                            ->setContainer(app())
                            ->setRedirector(app(Redirector::class))
                            ->validateResolved();
                        $this->categoryService->store($request->validated());
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                }
            }
        }
        if ($products_json != null) {
            foreach ($products_json as $product_json){
                if (isset($product_json['id']) && $product = Category::find($product_json['id'] != null)) {
                    try {
                        $request = new UpdateProductRequest($product_json);
                        $request
                            ->setContainer(app())
                            ->setRedirector(app(Redirector::class))
                            ->validateResolved();
                        $this->productService->update($request->validated(), $product);
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                } else {
                    try {
                        $request = new StoreProductRequest($product_json);
                        $request
                            ->setContainer(app())
                            ->setRedirector(app(Redirector::class))
                            ->validateResolved();
                        $this->productService->store($request->validated());
                    } catch (\Exception $e) {
                        Log::error($e);
                    }
                }
            }
        }
    }
}
