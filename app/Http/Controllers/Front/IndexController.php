<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use App\Models\Room;
use App\Models\Setting;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $setting = Setting::all();
        $rooms = Room::limit(4)->get();
        $hotel_facilities = HotelFacility::limit(6)->get();

        return view('/pages/index', compact('setting', 'rooms', 'hotel_facilities'));
    }
}
