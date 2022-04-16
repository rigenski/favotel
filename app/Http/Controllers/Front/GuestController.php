<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function index()
    {
        $guest = Guest::where('user_id', auth()->user()->id)->get()[0];

        $reservations = Reservation::where('guest_id', auth()->user()->guest->id)->paginate(5);

        return view('/pages/guest', compact('guest', 'reservations'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Profil gagal diperbarui');
        }

        $guest = Guest::where('user_id', auth()->user()->id)->get()[0];

        $guest->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
