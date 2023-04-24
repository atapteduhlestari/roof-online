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
}
