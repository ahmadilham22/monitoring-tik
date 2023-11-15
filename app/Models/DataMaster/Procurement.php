<?php

namespace App\Models\DataMaster;

use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procurement extends Model
{
    use HasFactory;

    protected $table = 'procurements';
    protected $fillable = [
        'mitra',
        'jenis_pengadaan',
        'tahun_pengadaan',
    ];

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'procurement_id', 'id');
    }
}
