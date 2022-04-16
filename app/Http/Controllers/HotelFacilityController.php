<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HotelFacilityController extends Controller
{
    public function index()
    {
        $hotel_facilities = HotelFacility::paginate(5);

        return view('/pages/admin/hotel-facilities/index', compact('hotel_facilities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Fasilitas Hotel gagal ditambahkan');
        }

        $hotel_facility = HotelFacility::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $rand = Str::random(20);
            $name_image = $rand . "." . $request->image->getClientOriginalExtension();
            $request->file('image')->move('images/uploads/hotel-facilities/', $name_image);
            $hotel_facility->image = $name_image;
            $hotel_facility->save();
        }

        return redirect()->back()->with('success', 'Data Fasilitas Hotel berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Fasilitas Hotel diperbarui');
        }

        $hotel_facility = HotelFacility::find($id);

        $hotel_facility->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $rand = Str::random(20);
            $name_image = $rand . "." . $request->image->getClientOriginalExtension();
            $request->file('image')->move('images/uploads/hotel-facilities/', $name_image);
            $hotel_facility->image = $name_image;
            $hotel_facility->save();
        }

        return redirect()->back()->with('success', 'Data Fasilitas Hotel berhasil diperbarui');
    }

    public function destroy($id)
    {
        HotelFacility::find($id)->delete();

        return redirect()->back()->with('success', 'Data Fasilitas Hotel berhasil dihapus');
    }
}
