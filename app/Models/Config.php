<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        'name', 'description', 'value', 'group'
    ];

    public $timestamps = false;
}
