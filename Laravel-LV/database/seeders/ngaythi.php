<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ngaythi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ngay')->insert([
            ['id' => 2,  'ngay_thi' => 'Thứ 2'],
            ['id' => 3,  'ngay_thi' => 'Thứ 3'],
            ['id' => 4,  'ngay_thi' => 'Thứ 4'],
            ['id' => 5,  'ngay_thi' => 'Thứ 5'],
            ['id' => 6,  'ngay_thi' => 'Thứ 6'],
            ['id' => 7,  'ngay_thi' => 'Thứ 7']
        ]);
    }
}