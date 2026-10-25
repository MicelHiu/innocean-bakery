<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = ['product_id', 'product_name', 'category', 'tier_id', 'recommended_price_IDR'];

    public function tier(): BelongsTo{
        return $this->belongsTo(Tier::class);
    }
}
