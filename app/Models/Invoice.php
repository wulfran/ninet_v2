<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'number', 'type', 'payment_method', 'issue_date', 'sell_date', 'issue_place', 'payment_date', 'file', 'user_id',
        'company_id', 'created_at', 'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function positions(): HasMany
    {
        return $this->hasMany(InvoicePosition::class);
    }
}
