<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('general_settings')->insert([
            'app_name' => 'My Laravel App',
            'timezone' => 'Asia/Karachi',
            'datetime_format' => 'Y-m-d H:i',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
