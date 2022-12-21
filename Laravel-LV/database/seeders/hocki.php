<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hocki extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hocki')->insert([
            ['id' => 1,  'hocki' => 'Học kì 1'],
            ['id' => 2,  'hocki' => 'Học kì 2'],
            ['id' => 3,  'hocki' => 'Học kì hè']

        ]);
    }
}