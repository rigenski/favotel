<?php

namespace App\Http\Controllers;

use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = Receptionist::paginate(5);

        return view('/pages/admin/receptionists/index', compact('receptionists'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Resepsionis gagal ditambahkan');
        }

        $user = User::create([
            "role" => "receptionist",
            "username" => $request->username,
            "password" => bcrypt($request->password)
        ]);

        Receptionist::create([
            "name" => $request->name,
            "user_id" => $user->id,
        ]);

        return redirect()->back()->with('success', 'Data Resepsionis berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Resepsionis gagal diperbarui');
        }

        $receptionist = Receptionist::find($id);

        $receptionist->update([
            'name' => $request->name,
        ]);

        if ($request->password !== null) {
            User::find($receptionist->user_id)->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);
        } else {
            User::find($receptionist->user_id)->update([
                'username' => $request->username,
            ]);
        }

        return redirect()->back()->with('success', 'Data Resepsionis berhasil diperbarui');
    }

    public function destroy($id)
    {
        $receptionist = Receptionist::find($id);

        $receptionist->delete();

        User::find($receptionist->user_id)->delete();

        return redirect()->back()->with('success', 'Data Resepsionis berhasil dihapus');
    }
}
