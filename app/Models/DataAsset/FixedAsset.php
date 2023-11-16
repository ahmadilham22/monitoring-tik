<?php

namespace App\Models\DataAsset;

use App\Models\DataMaster\Category;
use App\Models\DataMaster\Division;
use App\Models\DataMaster\Location;
use App\Models\DataMaster\Procurement;
use App\Models\DataMaster\SpecialLocation;
use App\Models\DataMaster\SubCategory;
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
        'category_id',
        'sub_category_id',
        'location_id',
        'specific_location_id',
        'division_id',
        'procurement_id',
        'kode_sn',
        'jumlah_barang',
        'penanggung_jawab',
        'jabatan',
        'kondisi',
        'tahun_perolehan',
        'keterangan',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function specificLocation()
    {
        return $this->belongsTo(SpecialLocation::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }
}
