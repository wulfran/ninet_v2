<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        factory(User::class, 5)->create();
    }
}
