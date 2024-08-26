<?php

namespace Database\Seeders;

use PermissionTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

    $this->call([
        PermissionTableSeeder::class,

    ]);
}

}
