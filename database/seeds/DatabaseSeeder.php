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
        // $this->call(UserSeeder::class);
        \App\Models\User::create([
            'email' => 'admin@ninet.pl',
            'name' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('secret'),
        ]);
    }
}
