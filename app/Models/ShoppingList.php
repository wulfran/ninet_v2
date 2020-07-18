<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shopping_lists';

    protected $fillable = ['name', 'created_at', 'updated_at', 'archived', 'user_id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'archived' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'shopping_list_items', 'list_id')
            ->withPivot(['unit', 'quantity', 'bought', 'optional', 'notes']);
    }
}
