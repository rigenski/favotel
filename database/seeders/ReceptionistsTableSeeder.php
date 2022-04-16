<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReceptionistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = "recept";
        $user->password = bcrypt("recept");
        $user->role = "receptionist";
        $user->save();

        $receptionist = new Receptionist();
        $receptionist->name = "recept";
        $receptionist->user_id = $user->id;
        $receptionist->save();
    }
}
