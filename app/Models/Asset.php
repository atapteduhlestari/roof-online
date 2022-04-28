<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'asset';
    protected $guarded = ['id'];
    protected $with = ['children'];

    public function group()
    {
        return $this->belongsTo(AssetGroup::class, 'asset_group_id');
    }

    public function children()
    {
        return $this->hasMany(AssetChild::class, 'asset_id');
    }

    public function trnMaintenance()
    {
        return $this->hasMany(TrnMaintenance::class, 'asset_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function sdb()
    {
        return $this->belongsTo(SDB::class, 'sdb_id');
    }

    public function trnSDBDetail()
    {
        return $this->hasOne(TrnSDBDetail::class, 'asset_id');
    }

    public function getTakeImageAttribute()
    {
        return "/storage/{$this->image}";
    }
}
