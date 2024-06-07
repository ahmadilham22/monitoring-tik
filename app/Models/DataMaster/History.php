<?php

namespace App\Models\DataMaster;

use App\Models\DataAsset\FixedAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'histories';

    protected $fillable = [
        'fixed_asset_id',
        'kondisi',
        'image',
    ];

    public function fixedAsset()
    {
        return $this->belongsTo(FixedAsset::class);
    }
}