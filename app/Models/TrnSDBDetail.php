<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnSDBDetail extends Model
{
    use HasFactory;

    protected $table = 'trn_sdb_detail';
    protected $guarded = ['id'];

    public function sdb()
    {
        return $this->belongsTo(SDB::class, 'sdb_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function document()
    {
        return $this->belongsTo(AssetChild::class, 'asset_child_id');
    }
}
