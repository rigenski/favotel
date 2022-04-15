<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use DateTime;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $reservation_id = session()->get('reservation-id');

        if ($reservation_id) {
            $reservation = Reservation::find($reservation_id);

            $first_day = new DateTime($reservation->check_in);
            $last_day = new DateTime($reservation->check_out);
            $interval = $first_day->diff($last_day);
            $total_days = $interval->format('%a');

            return view('/pages/result', compact('reservation', 'total_days'));
        } else {
            return redirect()->route('guest')->with('success', 'Reservasi belum dipesan');
        }
    }
}
