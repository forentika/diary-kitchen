<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_EWALLET = 'ewallet';
    const METHOD_CASH = 'cash';

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';

    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_status',
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'payment_method' => 'string',
        'payment_status' => 'string'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
