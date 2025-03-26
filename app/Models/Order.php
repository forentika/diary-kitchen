<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    const TYPE_TAKE_AWAY = 'take_away';
    const TYPE_DINE_IN = 'dine_in';

    const STATUS_PENDING = 'pending';
    const STATUS_COOKING = 'cooking';
    const STATUS_READY = 'ready';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'order_type',
        'table_number',
        'total_price',
        'status'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'order_type' => 'string',
        'status' => 'string',
        'table_number' => 'integer'
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
