<?php

namespace Tests\Unit;

use App\Models\Ad;
use App\Models\Advertiser;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdvertiserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_list_all_certain_advertiser_Ads()
    {
        $advertiser = Advertiser::factory()->create();
        $ads = Ad::factory()->count(4)->create(['advertiser_id' => $advertiser->id]);
        $otherAdvertisersAds = Ad::factory()->count(7)->create();

        $response = $this->get('api/v1/advertiser/{$advertiser->id}/ads');
        $result = $response->json('data');

        $this->assertEquals(200, $response->json('status'));
        $this->assertCount($ads->count(), $result);
    }


}
