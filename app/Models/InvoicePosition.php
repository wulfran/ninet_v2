<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Integer;

class InvoicePosition extends Model
{
    protected $table = 'invoice_positions';

    protected $fillable = [
        'name', 'quantity', 'unit', 'unit_price', 'tax', 'invoice_id'
    ];

    public $timestamps = null;

    CONST UNITS = [
        'unit' => 'Unit',
        'hour' => 'Hour',
    ];

    CONST TAX = [
        '23' => '23%',
        '8' => '8%',
        '0' => '0%',
    ];

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * @return string[]
     */
    public function getUnits(): array
    {
        return self::UNITS;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getUnit(string $key): string
    {
        return self::UNITS[$key];
    }

    /**
     * @return string[]
     */
    public function getTaxes(): array
    {
        return self::TAX;
    }
}
