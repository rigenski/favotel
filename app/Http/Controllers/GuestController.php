<?php

namespace App\Http\Controllers;

use App\Models\Guest;
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

        $guest->delete();

        User::find($guest->user_id)->delete();

        return redirect()->back()->with('success', 'Data Tamu berhasil dihapus');
    }
}
