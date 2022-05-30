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

    public function getTakeDocAttribute()
    {
        return "/storage/{$this->file}";
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['trn_date'] ?? false, function ($query, $trn_date) {
            return $query->where('created_at', $trn_date->month)->whereYear('created_at', $trn_date->year);
        });
    }
}
