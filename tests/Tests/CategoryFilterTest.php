<?php

use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;
use Tests\Controllers\CategoriesController;
use Tests\Models\Category;
use Tests\Seeds\CategoryTableSeeder;

/**
 * Class CategoryFilterTest.
 */
class CategoryFilterTest extends TestCase
{
    private function __initDb()
    {
        $seeder = new CategoryTableSeeder();
        $seeder->run();
    }

    /** @test */
    public function itCanGetCategoryByCategoryAndDateNull()
    {
        $this->__initDb();
        $request = new Request();
        $request->merge(
            [
                'category'   => 'Html',
                'created_at' => null,
            ]
        );
        $modelfilter = new ModelFilters(
            $request
        );

        $category = CategoriesController::filter_category($modelfilter);
        $category_pure = Category::where([
            'category'   => 'Html',
            'created_at' => null,
        ])->get();

        $this->assertEquals($category, $category_pure);
    }

    /** @test */
    public function itCanNotBeNullCategory()
    {
        $this->__initDb();
        $request = new Request();
        $request->merge(
            [
                'category'   => 'Html',
                'created_at' => null,
            ]
        );
        $modelfilter = new ModelFilters(
            $request
        );

        $category = CategoriesController::filter_category($modelfilter);

        $this->assertNotEmpty($category);
    }
}
