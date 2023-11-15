<?php

namespace App\Models\DataMaster;

use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = [
        'categories_id',
        'kode_sub_kategori',
        'nama_sub_kategori',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'sub_category_id', 'id');
    }
}
