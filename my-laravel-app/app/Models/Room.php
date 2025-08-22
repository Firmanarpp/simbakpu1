<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'floor',
        'description'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
