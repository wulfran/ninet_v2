<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['name', 'tax_number', 'description', 'created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'date'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_users');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
