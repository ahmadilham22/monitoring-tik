<?php

namespace App\Models\DataAsset;

use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\SubCategory;
use App\Models\DataMaster\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fixed_assets';
    protected $fillable = [
        'sub_category_id',
        'specific_location_id',
        'user_id',
        'procurement_id',
        'kode_bmn',
        'kode_sn',
        'jumlah_barang',
        'penanggung_jawab',
        'kondisi',
        'tahun_perolehan',
        'keterangan',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specificLocation()
    {
        return $this->belongsTo(SpecialLocation::class);
    }

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }
}