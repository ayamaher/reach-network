<?php

namespace Tests\Unit;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdTest extends TestCase
{
    use DatabaseMigrations;

    public function test_list_all_Ads()
    {
        $ads = Ad::factory()->count(4)->create();

        $response = $this->post('api/v1/ads', []);
        $result = $response->json('data');

        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($ads->count(), $result);
    }

    public function test_list_all_Ads_filtered_by_certain_categories()
    {
        $category = Category::factory()->create();
        $otherCategory = Category::factory()->create();

        $ads = Ad::factory()->count(3)->create(['category_id' => $category->id]);
        $otherCategoryAds = Ad::factory()->count(2)->create(['category_id' => $otherCategory->id]);

        $response = $this->post('api/v1/ads', ['categories_ids' => [$category->id]]);
        $result = $response->json('data');

        foreach ($result as $singleAd) {
            $this->assertEquals($singleAd['category_id'], $category->id);
        }
        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($ads->count(), $result);
    }


    public function test_list_all_Ads_filtered_by_certain_tags()
    {
        $tag = Tag::factory()->create();
        $otherTag = Tag::factory()->create();

        $ads = Ad::factory()->count(4)->create();
        foreach ($ads as $ad) {
            $ad->tags()->attach($tag->id);
        }

        $otherTagAds = Ad::factory()->count(6)->create();
        foreach ($otherTagAds as $otherTagAd) {
            $otherTagAd->tags()->attach($otherTag->id);
        }
        $response = $this->post('api/v1/ads', ['tags_ids' => [$tag->id]]);
        $result = $response->json('data');

        foreach ($result as $singleAd) {
            foreach ($singleAd['tags'] as $singleAdTag)
                $this->assertEquals($singleAdTag['id'], $tag->id);
        }
        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($ads->count(), $result);
    }

    public function test_list_all_Ads_filtered_by_both_certain_categories_and_tags()
    {
        $filteredCategory = Category::factory()->create();
        $otherCategory = Category::factory()->create();

        $filteredTag = Tag::factory()->create();
        $otherTag = Tag::factory()->create();

        $ads = Ad::factory()->count(4)->create(['category_id' => $filteredCategory->id]);
        foreach ($ads as $ad) {
            $ad->tags()->attach($filteredTag->id);
        }

        $otherTagAndCategoryAds = Ad::factory()->count(6)->create(['category_id' => $otherCategory->id]);
        foreach ($otherTagAndCategoryAds as $otherTagAndCategoryAd) {
            $otherTagAndCategoryAd->tags()->attach($otherTag->id);
        }
        $response = $this->post('api/v1/ads', ['categories_ids' => [$filteredTag->id], 'tags_ids' => [$filteredTag->id]]);
        $result = $response->json('data');

        foreach ($result as $singleAd) {
            $this->assertEquals($singleAd['category_id'], $filteredCategory->id);
            foreach ($singleAd['tags'] as $singleAdTag)
                $this->assertEquals($singleAdTag['id'], $filteredTag->id);
        }
        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($ads->count(), $result);
    }


}
