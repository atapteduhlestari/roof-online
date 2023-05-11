<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function document()
    {
        return $this->belongsTo(AssetChild::class, 'asset_child_id');
    }

    public function sbu()
    {
        return $this->belongsTo(SBU::class, 'sbu_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['start']  ?? false, function ($query, $from) {
            return $query->whereDate('loan_start_date', '>=', $from);
        });

        $query->when($filters['end']  ?? false, function ($query, $to) {
            return $query->whereDate('loan_due_date', '<=', $to);
        });

        $query->when($filters['sbu_id'] ?? false, function ($query, $sbu) {
            return $query->whereHas('sbu', function ($q) use ($sbu) {
                $q->where('sbu_id', $sbu);
            });
        });

        $query->when($filters['status']  ?? false, function ($query, $status) {
            return $query->whereNotNull('loan_date');
        });
    }
}
