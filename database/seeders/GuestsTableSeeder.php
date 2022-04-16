<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Database\Seeder;

class GuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = "guest";
        $user->password = bcrypt("guest");
        $user->role = "guest";
        $user->save();

        $guest = new Guest();
        $guest->name = "guest";
        $guest->user_id = $user->id;
        $guest->save();
    }
}
