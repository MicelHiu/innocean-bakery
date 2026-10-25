<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $primaryKey = 'store_id';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = ['store_id', 'store_name', 'address', 'city', 'province', 'tier_id'];

    public function tier(): BelongsTo{
        return $this->belongsTo(Tier::class);
    }
}
