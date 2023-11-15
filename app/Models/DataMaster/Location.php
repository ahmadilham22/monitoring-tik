<?php

namespace App\Models\DataMaster;

use Illuminate\Validation\Rule;
use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';
    protected $fillable = [
        'lokasi_umum'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($location) {
            $location->lokasi_umum = strtoupper($location->lokasi_umum);
        });
    }

    public function SpecialLocation(): HasMany
    {
        return $this->hasMany(SpecialLocation::class, 'location_id', 'id');
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'location_id', 'id');
    }
}
