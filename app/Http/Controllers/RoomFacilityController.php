<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomFacilityController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request;

        $rooms = Room::all();

        if ($request->has('room_type')) {
            $room_facilities = RoomFacility::where('room_id', $filter->room_type)->get();
        } else {
            $room_facilities = RoomFacility::where('room_id', $rooms[0]->id)->get();
        }

        return view('/pages/admin/room-facilities/index', compact('filter', 'room_facilities', 'rooms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facility' => 'required',
            'room_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Fasilitas Kamar gagal ditambahkan');
        }

        RoomFacility::create([
            'facility' => $request->facility,
            'room_id' => $request->room_type,
        ]);

        return redirect()->back()->with('success', 'Data Fasilitas Kamar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'facility' => 'required',
            'room_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Fasilitas Kamar gagal diperbarui');
        }

        $room_facility = RoomFacility::find($id);

        $room_facility->update([
            'facility' => $request->facility,
            'room_id' => $request->room_type,
        ]);

        return redirect()->back()->with('success', 'Data Fasilitas Kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        RoomFacility::find($id)->delete();

        return redirect()->back()->with('success', 'Data Kamar berhasil dihapus');
    }
}
