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
    protected $with = ['children', 'trnMaintenance', 'appraisals'];

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

    public static function getLastTransaction($time)
    {
        DB::statement("SET SQL_MODE=''");
        return DB::table('trn_maintenance')
            ->select(['trn_maintenance.*', 'trn_maintenance.id as trn_id', DB::raw('MAX(trn_maintenance.trn_start_date) as trn_start_date'), 'asset.*', 'asset_maintenance.*'])
            ->leftJoin('asset', 'trn_maintenance.asset_id', 'asset.id')
            ->leftJoin('asset_maintenance', 'trn_maintenance.maintenance_id', 'asset_maintenance.id')
            ->groupBy('asset_maintenance.name', 'asset.asset_name')
            ->where('trn_start_date', '<=', $time);
    }

    public static function generateButton($row)
    {
        '<div class="d-flex justify-content-around">
            <div>
                <a title="Asset Detail" href="/asset-parent/docs/' . $row->id . '" class="btn btn-outline-dark btn-sm">Detail</a>
            </div>
            <div>
                <a title="Edit Data" href="/asset-parent/' . $row->id . '/edit" class="btn btn-outline-dark btn-sm">Edit</a>
            </div>
            <div>
                <form action="/asset-parent/' . $row->id . '" method="post" id="deleteForm">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                    <button title="Delete Data" class="btn btn-outline-danger btn-sm" onclick="return false" id="deleteButton" data-id="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>';
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['date_before']  ?? false, function ($query, $from) {
            return $query->whereDate('pcs_date', '>=', $from);
        });

        $query->when($filters['date_after']  ?? false, function ($query, $to) {
            return $query->whereDate('pcs_date', '<=', $to);
        });

        $query->when($filters['sbu'] ?? false, function ($query, $sbu) {
            return $query->whereHas('SBU', function ($q) use ($sbu) {
                $q->where('sbu_id', $sbu);
            });
        });
    }
}
