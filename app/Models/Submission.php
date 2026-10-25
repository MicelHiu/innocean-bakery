<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $fillable = ['name', 'store_id', 'product_id'];

    public function store(): BelongsTo{
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function product():BelongsTo{
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
