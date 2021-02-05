<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoicePosition extends Model
{
    protected $table = 'invoice_positions';

    protected $fillable = [
        'name', 'quantity', 'unit', 'unit_price', 'tax', 'invoice_id'
    ];

    public $timestamps = null;

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
