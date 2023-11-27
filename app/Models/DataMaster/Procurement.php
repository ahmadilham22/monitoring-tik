<?php

namespace App\Models\DataMaster;

use Illuminate\Support\Carbon;
use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procurement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'procurements';
    protected $fillable = [
        'mitra',
        'jenis_pengadaan',
        'tahun_pengadaan',
    ];

    public function getTahunPengadaanAttribute($value)
    {
        return Carbon::parse($value)->format('Y');
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'procurement_id', 'id');
    }
}
