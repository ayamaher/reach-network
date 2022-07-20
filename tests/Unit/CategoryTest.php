<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_list_all_categories()
    {
        $categories = Category::factory()->count(5)->create();
        $response = $this->get('api/v1/categories');
        $result = $response->json('data');

        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($categories->count(), $result);
    }


    /**
     * @return void
     */
    public function test_should_create_new_category()
    {
        $catName = 'Category Name';
        $category = ['name' => $catName];

        $response = $this->post('api/v1/categories', $category);

        $this->assertEquals(201, $response->json('status'));
        $response->assertSee($catName);
        $this->assertDatabaseHas('categories', $category);

    }


    /**
     * @return void
     */
    public function test_should_update_category_name()
    {
        $category = Category::factory()->create();
        $newCatName = ['name' => 'New Category Name'];
        $response = $this->put("api/v1/categories/{$category->id}", $newCatName);

        $this->assertEquals(200, $response->json('status'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id, 'name' => $category->name]);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => $newCatName]);
    }


    /**
     * @return void
     */
    public function test_should_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete("api/v1/categories/{$category->id}");

        $this->assertEquals('category has been deleted', $response->json('message'));
        $this->assertEquals(1, $response->json('is_deleted'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
