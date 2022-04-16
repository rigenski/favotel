<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use App\Models\Room;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $rooms = Room::limit(4)->get();
        $hotel_facilities = HotelFacility::limit(6)->get();

        return view('/pages/index', compact('rooms', 'hotel_facilities'));
    }
}
