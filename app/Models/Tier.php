<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tier extends Model
{
    protected $fillable = ['name'];

    public function stores(): HasMany{
        return $this->hasMany(Store::class);
    }

    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }
}
