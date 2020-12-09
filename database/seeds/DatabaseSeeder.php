<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(VendorSeeder::class);
        // $this->call(DishesSeeder::class);
        // $this->call(OrderSeeder::class);
    }
}
