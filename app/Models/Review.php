<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    const MIN_RATING = 1;
    const MAX_RATING = 5;

    protected $fillable = [
        'order_id',
        'rating',
        'comment',
        'review_date'
    ];

    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'datetime'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
