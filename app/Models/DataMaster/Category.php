<?php

namespace App\Models\DataMaster;

use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
    ];

    public function SubCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'categories_id', 'id');
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'categories_id', 'id');
    }
}
