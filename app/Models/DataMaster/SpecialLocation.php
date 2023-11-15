<?php

namespace App\Models\DataMaster;

use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialLocation extends Model
{
    use HasFactory;

    protected $table = 'specific_locations';
    protected $fillable = [
        'location_id',
        'kode_lokasi',
        'lokasi_khusus',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'specific_location', 'id');
    }
}
