<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Ad;


class AdvertiserController extends Controller
{

    public function listAdvertiserAds($id)
    {
        $advertiserAds = Ad::where('advertiser_id', $id)->get();
        return response()->json(['data' => $advertiserAds->toArray(), 'status' => 200]);
    }
}
