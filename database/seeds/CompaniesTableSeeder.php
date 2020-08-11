<?php

use App\Models\Address;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0;$i<50;$i++) {
            $address = factory(Address::class)->create();
            $company = $address->company()->create(factory(\App\Models\Company::class)->make()->toArray());
            $company->users()->saveMany(factory(\App\Models\User::class, rand(1,4))->create());
        }
    }
}
