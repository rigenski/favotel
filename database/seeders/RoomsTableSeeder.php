<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => 'Basic',
                'price' => 120000,
                'total_rooms' => 20,
            ],
            [
                'name' => 'Medium',
                'price' => 180000,
                'total_rooms' => 16,
            ],
            [
                'name' => 'Premium',
                'price' => 240000,
                'total_rooms' => 18,
            ],
        ];

        DB::table('rooms')->insert($rooms);
    }
}
