<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'number', 'type', 'price_type', 'issue_date', 'sell_date', 'issue_place', 'payment_date', 'file', 'user_id',
        'company_id', 'created_at', 'updated_at'
    ];
}
