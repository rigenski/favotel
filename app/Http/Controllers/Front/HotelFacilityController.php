<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use App\Models\Setting;
use Illuminate\Http\Request;

class HotelFacilityController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        $hotel_facilities = HotelFacility::all();

        return view('/pages/hotel-facilities', compact('setting', 'hotel_facilities'));
    }
}
