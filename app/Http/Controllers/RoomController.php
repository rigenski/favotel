<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('/pages/admin/rooms/index', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cost' => 'required',
            'total_rooms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Kamar gagal ditambahkan');
        }

        $room = Room::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'total_rooms' => $request->total_rooms,
        ]);

        if ($request->hasFile('image')) {
            $rand = Str::random(20);
            $name_image = $rand . "." . $request->image->getClientOriginalExtension();
            $request->file('image')->move('images/uploads/rooms/', $name_image);
            $room->image = $name_image;
            $room->save();
        }

        return redirect()->back()->with('success', 'Data Kamar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cost' => 'required',
            'total_rooms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Kamar gagal diperbarui');
        }

        $room = Room::find($id);

        $room->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'total_rooms' => $request->total_rooms,
        ]);

        if ($request->hasFile('image')) {
            $rand = Str::random(20);
            $name_image = $rand . "." . $request->image->getClientOriginalExtension();
            $request->file('image')->move('images/uploads/rooms/', $name_image);
            $room->image = $name_image;
            $room->save();
        }

        return redirect()->back()->with('success', 'Data Kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        Room::find($id)->delete();

        return redirect()->back()->with('success', 'Data Kamar berhasil dihapus');
    }
}
