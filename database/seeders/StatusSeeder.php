<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insertOrIgnore([
            ['description' => 'Waiting for Approval'],
            ['description' => 'Approved'],
            ['description' => 'Denied'],
        ]);
    }
}
