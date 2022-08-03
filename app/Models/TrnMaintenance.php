<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnMaintenance extends Model
{
    use HasFactory;

    protected $table = 'trn_maintenance';
    protected $guarded = ['id'];
    // protected $with = ['maintenance'];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sbu()
    {
        return $this->belongsTo(SBU::class, 'sbu_id');
    }

    public function getTakeDocAttribute()
    {
        return "/storage/{$this->file}";
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['start_date']  ?? false, function ($query, $from) {
            return $query->whereDate('trn_start_date', '>=', $from);
        });

        $query->when($filters['due_date']  ?? false, function ($query, $to) {
            return $query->whereDate('trn_date', '<=', $to);
        });

        $query->when($filters['sbu_search_id'] ?? false, function ($query, $sbu) {
            return $query->whereHas('sbu', function ($q) use ($sbu) {
                $q->where('sbu_id', $sbu);
            });
        });

        $query->when($filters['status']  ?? false, function ($query, $status) {
            return $query->where('trn_status', $status);
        });
    }
}
