<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'asset';
    protected $guarded = ['id'];
    protected $with = ['children', 'trnMaintenance'];

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

    public function lastTransaction()
    {
        return $this->hasOne(TrnMaintenance::class, 'asset_id')->latest();
    }

    public function getTakeImageAttribute()
    {
        return "/storage/{$this->image}";
    }

    public function getLastTransaction($time)
    {
        DB::statement("SET SQL_MODE=''");
        return DB::table('trn_maintenance')
            ->select(['trn_maintenance.*', DB::raw('MAX(trn_maintenance.trn_start_date) as trn_start_date'), 'asset.*', 'asset_maintenance.*'])
            ->leftJoin('asset', 'trn_maintenance.asset_id', 'asset.id')
            ->leftJoin('asset_maintenance', 'trn_maintenance.maintenance_id', 'asset_maintenance.id')
            ->groupBy('asset_maintenance.name', 'asset.asset_name');
    }
}
