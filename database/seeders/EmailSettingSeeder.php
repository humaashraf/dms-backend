<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_settings')->insert([
            'smtp_host' => 'smtp.gmail.com',
            'username' => 'dms@gmail.com',
            'password' => '123456',
            'smtp_secure' => 'tls',
            'port' => 587,
            'from_email' => 'dms@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
