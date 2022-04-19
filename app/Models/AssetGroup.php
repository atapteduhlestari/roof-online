<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetGroup extends Model
{
    use HasFactory;
    protected $table = 'asset_group';
    protected $guarded = ['id'];
    protected $with = ['assets'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'asset_group_id');
    }

    public function assetsChildren()
    {
        return $this->hasManyThrough(Asset::class, AssetChild::class, 'asset_group_id', 'asset_id');
    }
}
