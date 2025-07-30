<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class FixProductImageUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:product-image-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix product image URLs to use proper Storage::url format';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fix product image URLs...');

        // Fix main product images
        $products = Product::whereNotNull('image_path')->get();
        $productCount = 0;

        foreach ($products as $product) {
            if ($product->image_path) {
                $correctUrl = Storage::disk('public')->url($product->image_path);
                
                // Only update if URL is different
                if ($product->image_url !== $correctUrl) {
                    $product->update(['image_url' => $correctUrl]);
                    $productCount++;
                    $this->line("Fixed product {$product->id}: {$product->name}");
                }
            }
        }

        // Fix product images
        $productImages = ProductImage::whereNotNull('image_path')->get();
        $imageCount = 0;

        foreach ($productImages as $image) {
            if ($image->image_path) {
                $correctUrl = Storage::disk('public')->url($image->image_path);
                
                // Only update if URL is different
                if ($image->image_url !== $correctUrl) {
                    $image->update(['image_url' => $correctUrl]);
                    $imageCount++;
                    $this->line("Fixed image {$image->id} for product {$image->product_id}");
                }
            }
        }

        $this->info("Completed! Fixed {$productCount} product main images and {$imageCount} additional images.");
        
        return Command::SUCCESS;
    }
}
