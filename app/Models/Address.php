<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'street', 'street_number', 'post_code', 'city', 'country'
    ];

    public $timestamps = false;

    public function company()
    {
        return $this->hasOne(Company::class, 'address_id', 'id');
    }
}
