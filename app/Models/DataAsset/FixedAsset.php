<?php

namespace App\Models\DataAsset;

use App\Models\DataMaster\User;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\History;
use App\Models\DataMaster\Location;
use Illuminate\Support\Facades\Log;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\Unit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class FixedAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    protected $table = 'fixed_assets';
    public $incrementing = false;

    protected $fillable = [
        'sub_category_id',
        'specific_location_id',
        'user_id',
        'unit_id',
        'procurement_id',
        'kode_bmn',
        'kode_sn',
        'jumlah_barang',
        'penanggung_jawab',
        'kondisi',
        'harga',
        'tahun_perolehan',
        'keterangan',
        'qrcode',
    ];


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->{$model->getKeyName()})) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function specificLocation()
    {
        return $this->belongsTo(SpecialLocation::class);
    }

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'fixed_asset_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($fixedAsset) {
            $fixedAsset->histories()->delete();
        });
    }
}
