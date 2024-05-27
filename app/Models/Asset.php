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
    protected $with = ['group', 'children', 'trnMaintenance', 'appraisals', 'sbu', 'employee'];

    public function group()
    {
        return $this->belongsTo(AssetGroup::class, 'asset_group_id');
    }

    public function children()
    {
        return $this->hasMany(AssetChild::class, 'asset_id');
    }

    public function appraisals()
    {
        return $this->hasMany(Appraisal::class, 'asset_id');
    }

    public function trnMaintenance()
    {
        return $this->hasMany(TrnMaintenance::class, 'asset_id');
    }

    public function sbu()
    {
        return $this->belongsTo(SBU::class, 'sbu_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function sdb()
    {
        return $this->belongsTo(SDB::class, 'sdb_id');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'asset_id');
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

    public static function getAllLastTransaction($time)
    {

        return DB::table('trn_maintenance')
            ->select(['trn_maintenance.*', 'trn_maintenance.id as trn_id', 'asset.*', 'asset_maintenance.*', 'sbu.sbu_name'])
            ->join('sbu', 'trn_maintenance.sbu_id', 'sbu.id')
            ->join('asset', 'trn_maintenance.asset_id', 'asset.id')
            ->join('asset_maintenance', 'trn_maintenance.maintenance_id', 'asset_maintenance.id')
            // ->groupBy('asset_maintenance.name', 'asset.asset_name')
            ->where('trn_date', '<=', $time)
            ->where('trn_status', false);
    }

    public static function getLastTransaction($time)
    {
        DB::statement("SET SQL_MODE=''");

        if (isSuperadmin()) {
            return DB::table('trn_maintenance')
                ->select(['trn_maintenance.*', 'trn_maintenance.id as trn_id', 'asset.*', 'asset_maintenance.*', 'sbu.sbu_name'])
                ->join('sbu', 'trn_maintenance.sbu_id', 'sbu.id')
                ->join('asset', 'trn_maintenance.asset_id', 'asset.id')
                ->join('asset_maintenance', 'trn_maintenance.maintenance_id', 'asset_maintenance.id')
                // ->groupBy('asset_maintenance.name', 'asset.asset_name')
                ->where('trn_date', '<=', $time)
                ->where('trn_status', false);
        } else {
            return DB::table('trn_maintenance')
                ->select(['trn_maintenance.*', 'trn_maintenance.id as trn_id', 'asset.*', 'asset_maintenance.*', 'sbu.sbu_name'])
                ->join('asset', 'trn_maintenance.asset_id', 'asset.id')
                ->join('asset_maintenance', 'trn_maintenance.maintenance_id', 'asset_maintenance.id')
                ->join('sbu', 'trn_maintenance.sbu_id', 'sbu.id')
                // ->groupBy('asset_maintenance.name', 'asset.asset_name')
                ->where('trn_date', '<=', $time)
                ->where('trn_maintenance.sbu_id', userSBU())
                ->where('trn_status', false);
        }
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['start']  ?? false, function ($query, $from) {
            return $query->whereDate('pcs_date', '>=', $from);
        });


        $query->when($filters['end']  ?? false, function ($query, $to) {
            return $query->whereDate('pcs_date', '<=', $to);
        });

        $query->when($filters['sbu_id'] ?? false, function ($query, $sbu) {
            return $query->whereHas('sbu', function ($q) use ($sbu) {
                $q->where('sbu_id', $sbu);
            });
        });

        $query->when($filters['condition']  ?? false, function ($query, $condition) {
            return $query->where('condition', $condition);
        });
    }

    public function scopeSearch($query, $filters)
    {
        $query->when($filters['search_date_before']  ?? false, function ($query, $from) {
            return $query->whereDate('pcs_date', '>=', $from);
        });

        $query->when($filters['search_date_after']  ?? false, function ($query, $to) {
            return $query->whereDate('pcs_date', '<=', $to);
        });

        $query->when($filters['sbu_search_id'] ?? false, function ($query, $sbu) {
            return $query->whereHas('sbu', function ($q) use ($sbu) {
                $q->where('sbu_id', $sbu);
            });
        });

        $query->when($filters['group_search_id'] ?? false, function ($query, $group) {
            return $query->whereHas('group', function ($q) use ($group) {
                $q->where('asset_group_id', $group);
            });
        });

        $query->when($filters['search_condition']  ?? false, function ($query, $condition) {
            return $query->where('condition', $condition);
        });
    }
}
