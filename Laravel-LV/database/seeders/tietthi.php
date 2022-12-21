<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tietthi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gio')->insert([
            ['id' => 1,  'tiet' => 'Tiết 1', 'start_time' => '7:00 AM', 'end_time' => '7:50 AM'],
            ['id' => 2,  'tiet' => 'Tiết 2', 'start_time' => '7:50 AM', 'end_time' => '8:40 AM'],
            ['id' => 3,  'tiet' => 'Tiết 3', 'start_time' => '8:50 AM', 'end_time' => '9:40 AM'],
            ['id' => 4,  'tiet' => 'Tiết 4', 'start_time' => '9:50 AM', 'end_time' => '10:40 AM'],
            ['id' => 5,  'tiet' => 'Tiết 5', 'start_time' => '10:40 AM', 'end_time' => '11:30 AM'],
            ['id' => 6,  'tiet' => 'Tiết 6', 'start_time' => '1:30 PM', 'end_time' => '2:20 PM'],
            ['id' => 7,  'tiet' => 'Tiết 7', 'start_time' => '2:20 PM', 'end_time' => '3:10 PM'],
            ['id' => 8,  'tiet' => 'Tiết 8', 'start_time' => '3:20 PM', 'end_time' => '4:10 PM'],
            ['id' => 9,  'tiet' => 'Tiết 9', 'start_time' => '4:10 PM', 'end_time' => '5:00 PM'],
        ]);
    }
}