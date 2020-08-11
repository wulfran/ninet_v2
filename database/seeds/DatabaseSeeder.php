<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');

        $this->call(UsersTableSeeder::class);
        $this->call(ShoppingListsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
    }
}
