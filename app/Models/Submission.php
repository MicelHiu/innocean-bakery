<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $fillable = ['name', 'store_id', 'product_id'];

    public function store(): BelongsTo{
        return $this->belongsTo(Store::class);
    }

    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
