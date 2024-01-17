<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertNotNull;

class ProductTest extends TestCase
{

    public function testOneToMany(): void
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::find('FOOD');
        assertNotNull($category);

        $products = $category->products;
        assertNotNull($products);
        assertCount(1, $products);
    }

    public function testInsertRelationship()
    {
        $category = new Category();
        $category->id = 'FOOD';
        $category->name = 'Food';
        $category->description = "Food Category";
        $category->is_active = true;
        $category->save();
        assertNotNull($category);

        $product = new Product();
        $product->name = 'Product 1';
        $product->description = 'Desc Product 1';
        
        $category->products()->save($product);
        assertNotNull($product->category_id);
    }

    public function testQueryRelationship()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);
        
        $category = Category::find('FOOD');
        $outOfStockProducts = $category->products()->where('stock', '<=', 0)->get();

        assertCount(1, $outOfStockProducts);
    }
}
