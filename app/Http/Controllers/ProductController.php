<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\IndexProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Processors\InputProcessorFactoryInterface;

class ProductController extends Controller
{
    public function __construct(
        private InputProcessorFactoryInterface $inputProcessorFactory,
        protected ProductRepositoryInterface $productRepository,
        protected CategoryRepositoryInterface $categoryRepository,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(IndexProductRequest $request)
    {
        return Inertia::render('products/Index', [
            'products' => $this->productRepository->all($request),
            'categories' => $this->categoryRepository->all(),
            'filters' => $request->only(['category', 'sort']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('products/Create', [
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $productDTO = $this->inputProcessorFactory->getProcessor('request')->process($request);

        $this->productRepository->create($productDTO);

        return redirect()->intended(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product->id);

        return redirect()->intended(route('products.index'));
    }
}
