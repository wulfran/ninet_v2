<?php

namespace App\Models;

/**
 * Class Config for app configuration.
 * TODO: Configs are hardcoded for now, after Invoice branch is done, rework this to DB store
 * @package App\Models
 */
class Config
{
    private $name, $tax_number, $address;

    public function __construct()
    {
        $configs = config('configs');

        foreach ($configs as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTaxNumber()
    {
        return $this->tax_number;
    }

    public function getAddress()
    {
        $country = Country::find($this->address['country_id']);
        unset($this->address['country_id']);
        $this->address['country'] = $country->name;

        return $this->address;
    }
}
