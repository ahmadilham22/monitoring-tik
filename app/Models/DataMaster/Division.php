<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'divisions';
    protected $fillable = [
        'nama_divisi'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($division) {
            $division->nama_divisi = strtoupper($division->nama_divisi);
        });
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'division_id', 'id');
    }
}
