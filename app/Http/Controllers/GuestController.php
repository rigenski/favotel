<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::all();

        return view('/pages/admin/guests/index', compact('guests'));
    }

    public function destroy($id)
    {

        $guest = Guest::find($id);

        $guest->delete();

        User::find($guest->user_id)->delete();

        return redirect()->back()->with('success', 'Data Tamu berhasil dihapus');
    }
}
