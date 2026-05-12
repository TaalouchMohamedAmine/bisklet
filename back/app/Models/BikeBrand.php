<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BikeBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function bikeModels(): HasMany
    {
        return $this->hasMany(BikeModel::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
