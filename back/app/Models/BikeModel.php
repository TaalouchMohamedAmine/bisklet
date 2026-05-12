<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BikeModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_brand_id',
        'name',
        'slug',
        'bike_type',
        'description',
    ];

    public function bikeBrand(): BelongsTo
    {
        return $this->belongsTo(BikeBrand::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
