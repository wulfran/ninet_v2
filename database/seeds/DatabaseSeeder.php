<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@ninet.pl',
            'name' => 'admin',
            'password' => Hash::make('secret'),
        ]);

        Artisan::call('passport:install');

        factory(User::class, 20)->create();

        $this->call(ShoppingListsSeeder::class);
    }
}
