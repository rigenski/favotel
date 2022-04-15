<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        $rooms = Room::all();

        return view('/pages/admin/reservations/index', compact('reservations', 'rooms'));
    }

    public function destroy($id)
    {
        Reservation::find($id)->delete();

        return redirect()->back()->with('success', 'Data Reservasi berhasil dihapus');
    }
}
