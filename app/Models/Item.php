<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = ['name', 'description', 'created_at', 'updated_at'];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function list()
    {
        return $this->belongsToMany(ShoppingList::class, 'shopping_list_items')
            ->withPivot(['unit', 'quantity', 'bought', 'optional', 'notes']);
    }
}
