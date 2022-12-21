<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(user::class);
        $this->call(hocki::class);
        $this->call(ngaythi::class);
        $this->call(tietthi::class);
    }
}