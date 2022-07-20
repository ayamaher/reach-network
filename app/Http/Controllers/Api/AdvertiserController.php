<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Advertiser;
use App\Repositories\AdRepo;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
{

    public function listAdvertiserAds($id)
    {
        $ads = Advertiser::where('id', $id)->with('ads')->get();
        eval(\Psy\sh());
        return response()->json(['data' => $ads, 'status' => 200]);
    }
}
