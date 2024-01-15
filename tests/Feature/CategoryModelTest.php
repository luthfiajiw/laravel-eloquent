<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Scopes\IsActiveScope;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class CategoryModelTest extends TestCase
{
    public function testCategory()
    {
        $request = [
            "id" => "A0003",
            "name" => "Food",
            "description" => "Food Category"
        ];

        $category = new Category($request);
        $category->save();

        assertNotNull($category->id);
    }

    public function testMassUpdate()
    {
        $this->seed(CategorySeeder::class);

        $request = [
            "name" => "Food Updated",
            "description" => "Food Category Updated"
        ];

        $category = Category::find('FOOD');
        $category->fill($request);
        $category->save();

        assertEquals("Food Updated", $category->name);
    }

    public function testIsActiveScope()
    {
        $category = new Category();
        $category->id = 'FOOD';
        $category->name = 'Food';
        $category->description = 'Food Category';
        $category->save();

        $category = Category::find('FOOD');
        assertNull($category);

        $category = Category::withoutGlobalScope(IsActiveScope::class)->find('FOOD');
        assertNotNull($category);
    }
}
