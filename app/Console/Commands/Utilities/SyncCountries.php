<?php

namespace App\Console\Commands\Utilities;

use App\Models\CallingCode;
use App\Models\Country;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SyncCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download countries information and populate the DB';

    private $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->client->request('GET', 'https://restcountries.eu/rest/v2/all');

        $data = json_decode($response->getBody()->getContents());

        $bar = $this->output->createProgressBar(count($data));

        foreach ($data as $country) {
            $savedCountry = Country::create([
                'name' => $country->name,
                'alpha2Code' => $country->alpha2Code,
                'alpha3Code' => $country->alpha3Code,
                'region' => $country->region,
                'flag' => $country->flag,
            ]);
            foreach($country->callingCodes as $code) {
                $savedCountry->callingCodes()->create([
                    'calling_code' => $code,
                ]);
            }
            $bar->advance();
        }
        $bar->finish();

        return 1;
    }
}
