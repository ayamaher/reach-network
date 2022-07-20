<?php

namespace Tests\Unit;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagTest extends TestCase
{
    use DatabaseMigrations;

    public function test_list_all_tags()
    {
        $tags = Tag::factory()->count(5)->create();

        $response = $this->get('api/v1/tags');
        $result = $response->json('data');

        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($tags->count(), $result);
    }


    /**
     * @return void
     */
    public function test_should_create_new_tag()
    {
        $tagName = 'Tag Name';
        $tag = ['name' => $tagName];

        $response = $this->post('api/v1/tags', $tag);

        $this->assertEquals(201, $response->json('status'));
        $response->assertSee($tagName);
        $this->assertDatabaseHas('tags', $tag);
    }


    /**
     * @return void
     */
    public function test_should_update_tag_name()
    {
        $tag = Tag::factory()->create();
        $newTagName = ['name' => 'New Tag Name'];
        $response = $this->put("api/v1/tags/{$tag->id}", $newTagName);

        $this->assertEquals(200, $response->json('status'));

        $this->assertDatabaseMissing('tags', ['id' => $tag->id, 'name' => $tag->name]);
        $this->assertDatabaseHas('tags', ['id' => $tag->id, 'name' => $newTagName]);
    }


    /**
     * @return void
     */
    public function test_should_delete_tag()
    {
        $tag = Tag::factory()->create();

        $response = $this->delete("api/v1/tags/{$tag->id}");

        $this->assertEquals('tag has been deleted', $response->json('message'));
        $this->assertEquals(1, $response->json('is_deleted'));
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
