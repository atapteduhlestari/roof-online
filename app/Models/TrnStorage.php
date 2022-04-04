<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnStorage extends Model
{
    use HasFactory;

    protected $table = 'trn_storage';
    protected $guarded = ['id'];

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function assetChildren()
    {
        return $this->belongsTo(AssetChild::class, 'asset_child_id');
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
