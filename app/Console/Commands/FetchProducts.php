<?php
namespace app\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class FetchProducts extends Command
{
    protected $signature = 'products:fetch';
    protected $description = 'Fetch products from FakeStore API';

    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        
        if ($response->successful()) {
            $products = $response->json();

            foreach ($products as $product) {
                Product::updateOrCreate(
                    ['api_id' => $product['id']],
                    [
                        'title' => $product['title'],
                        'price' => $product['price'],
                        'description' => $product['description'],
                        'category' => $product['category'],
                        'image' => $product['image'],
                        'rating' => json_encode($product['rating'])
                    ]
                );
            }

            $this->info('Successfully fetched ' . count($products) . ' products');
        } else {
            $this->error('Failed to fetch products. Status Code: ' . $response->status());
        }
    }
}
