<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Receptionist;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        $guests = Guest::all();
        $rooms = Room::all();

        return view('/pages/admin/index', compact('reservations', 'guests', 'rooms'));
    }
}
