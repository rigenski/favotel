<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\ReservationStatusHistory;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request;

        if ($filter->keyword) {
            $guests = Guest::where('name', 'like', "%" . $filter->keyword . "%")->paginate(5);
        } else {
            $guests = Guest::paginate(5);
        }

        return view('/pages/admin/guests/index', compact('filter', 'guests'));
    }

    public function destroy($id)
    {

        $guest = Guest::find($id);

        $reservations = Reservation::where('guest_id', $guest->id)->get();

        foreach ($reservations as $reservation) {
            $reservation_status_histories = ReservationStatusHistory::where('reservation_id', $reservation->id)->get();

            foreach ($reservation_status_histories as $reservation_status_history) {
                $reservation_status_history->delete();
            }

            $reservation->delete();
        }

        $guest->delete();

        User::find($guest->user_id)->delete();

        return redirect()->back()->with('success', 'Data Tamu berhasil dihapus');
    }
}
