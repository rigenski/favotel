<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use Illuminate\Http\Request;

class HotelFacilityController extends Controller
{
    public function index()
    {
        $hotel_facilities = HotelFacility::all();

        return view('/pages/hotel-facilities', compact('hotel_facilities'));
    }
}
