<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Repositories\AdRepo;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected $adRepo;

    public function __construct(AdRepo $adRepo)
    {
        $this->adRepo = $adRepo;
    }

    public function listAds(Request $request)
    {
        $ads =  $this->adRepo->getAdsByFilters($request->all());
        return response()->json(['data' => $ads, 'status' => 200]);
    }
}
