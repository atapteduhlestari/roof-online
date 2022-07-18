<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnRenewal extends Model
{
    use HasFactory;

    protected $table = 'trn_renewal';
    protected $guarded = ['id'];

    public function document()
    {
        return $this->belongsTo(AssetChild::class, 'asset_child_id');
    }

    public function renewal()
    {
        return $this->belongsTo(Renewal::class);
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
        $query->when($filters['trn_date'] ?? false, function ($query, $trn_date) {
            return $query->where('created_at', $trn_date->month)->whereYear('created_at', $trn_date->year);
        });
    }
}
