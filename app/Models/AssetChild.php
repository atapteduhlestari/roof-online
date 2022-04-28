<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetChild extends Model
{
    use HasFactory;

    protected $table = 'asset_child';
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function trnRenewal()
    {
        return $this->hasMany(TrnRenewal::class, 'asset_child_id');
    }

    public function sdb()
    {
        return $this->belongsTo(SDB::class, 'sdb_id');
    }

    public function trnSDBDetail()
    {
        return $this->hasOne(TrnSDBDetail::class, 'asset_child_id');
    }
}
