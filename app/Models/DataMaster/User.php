<?php

namespace App\Models\DataMaster;

use App\Http\Traits\AvoidDuplicateConstraintSoftDelete;
use App\Models\DataAsset\FixedAsset;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    protected $table = 'users';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
        'email',
        'password',
        'role',
        'jabatan',
        'division_id',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class, 'user_id', 'id');
    }

    // public function getDuplicateAvoidColumns(): array
    // {
    //     return [
    //         'email'
    //     ];
    // }
}
