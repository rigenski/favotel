<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelFacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotel_facilities = [
            [
                'name' => 'Sarapan gratis',
                'description' => 'Pellentesque in ipsum id orci porta dapibus',
            ],
            [
                'name' => 'Restoran',
                'description' => 'Nulla porttitor accumsan tincidunt',
            ],
            [
                'name' => 'Wi-Fi gratis',
                'description' => 'Curabitur arcu erat, accumsan id imperdiet et',
            ],
            [
                'name' => 'Kolam renang',
                'description' => 'Vestibulum ac diam sit amet quam vehicula',
            ],
            [
                'name' => 'Bar',
                'description' => 'Sed porttitor lectus nibh',
            ],
        ];

        DB::table('hotel_facilities')->insert($hotel_facilities);
    }
}
