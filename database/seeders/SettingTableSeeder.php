<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->name = "Favotel";
        $setting->description = "Curabitur aliquet quam id dui posuere blandit";
        $setting->email = "favotel@email.com";
        $setting->phone = "08123456789";
        $setting->address = "jl. ipsum id orci porta dapibus";
        $setting->save();
    }
}
