<?php

namespace App\Console\Commands;

use Illuminate\Http\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ProductRepositoryInterface;
use App\Processors\InputProcessorFactoryInterface;

class CreateProduct extends Command
{
    public function __construct(
        private InputProcessorFactoryInterface $inputProcessorFactory,
        private ProductRepositoryInterface $productRepository
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create
        {name : Product name}
        {description : Product description}
        {price : Product price}
        {image : Path to product image}
        {categories : Comma-separated category IDs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create the product from cli';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $validator = Validator::make(
            [
                ...$this->input->getArguments(),
                'image' => new File($this->input->getArgument('image')),
                'categories' => explode(',', $this->input->getArgument('categories'))
            ],
            [
                'name' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:jpg,bmp,png',
                'categories' => 'required|array',
                'categories.*' => 'required|exists:categories,id',
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return Command::FAILURE;
        }

        $productDTO = $this->inputProcessorFactory->getProcessor('console')->handle($this->input);

        $product = $this->productRepository->create($productDTO);

        $this->info("Product {$product->name} created successfully!");
    }
}
