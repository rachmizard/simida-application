<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location\Province;
use App\Location\Regency;
use App\Location\District;
use App\Location\Village;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function province(): JsonResponse
    {
    	return response()->json(['data' => Province::orderBy('id', 'ASC')->get()]);
    }

    public function regency($provinceId): JsonResponse
    {
    	return response()->json(['data' => Regency::whereProvinceId($provinceId)->orderBy('name', 'DESC')->get()]);
    }

    public function district($regencyId): JsonResponse
    {
    	return response()->json(['data' => District::whereRegencyId($regencyId)->orderBy('name', 'DESC')->get()]);
    }

    public function village($districtId): JsonResponse
    {
    	return response()->json(['data' => Village::whereDistrictId($districtId)->orderBy('name', 'DESC')->get()]);
    }
}
