<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDB extends Model
{
    use HasFactory;

    protected $table = 'sdb';
    protected $guarded = ['id'];
    protected $with = ['trnSDB'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'sdb_id');
    }

    public function docs()
    {
        return $this->hasMany(AssetChild::class, 'sdb_id');
    }

    public function trnSDB()
    {
        return $this->hasMany(TrnSDB::class, 'sdb_id');
    }
}
