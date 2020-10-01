<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public $timestamps = false;

    protected $fillable = [
        'name', 'alpha2Code', 'alpha3Code', 'region', 'timezone', 'flag'
    ];

    public function callingCodes()
    {
        return $this->hasMany(CallingCode::class);
    }
}
