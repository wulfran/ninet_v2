<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallingCode extends Model
{
    protected $table = 'calling_codes';

    public $timestamps = false;

    protected $fillable = ['calling_code', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
