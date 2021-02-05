<?php

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                'name' => 'name',
                'description' => 'Your company name',
                'value' => 'NiNet',
                'group' => 'company'
            ],
            [
                'name' => 'street',
                'description' => 'Address street',
                'value' => 'Chorzemin',
                'group' => 'company'
            ],
            [
                'name' => 'street_number',
                'description' => 'Address street number',
                'value' => '45a',
                'group' => 'company'
            ],
            [
                'name' => 'city',
                'description' => 'Address city',
                'value' => 'Chorzemin',
                'group' => 'company'
            ],
            [
                'name' => 'post_code',
                'description' => 'Address post code',
                'value' => '64-200',
                'group' => 'company'
            ],
            [
                'name' => 'Country',
                'description' => 'Address country',
                'value' => 'Poland',
                'group' => 'company'
            ],
            [
                'name' => 'tax_number',
                'description' => 'Company tax number',
                'value' => '123456789',
                'group' => 'company'
            ],
        ];

        foreach ($configs as $config) {
            Config::create($config);
        }
    }
}
