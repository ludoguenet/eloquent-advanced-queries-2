<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Getters

    // protected function itemPrice(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn() => $this->orderItems->sum(fn(OrderItem $orderItem) => $orderItem->price * $orderItem->quantity)
    //     );
    // }
}
