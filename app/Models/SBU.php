<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SBU extends Model
{
    use HasFactory;
    protected $table = 'sbu';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->hasMany('App\User')->orderBy('nama_lokasi', 'ASC');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'sbu_id');
    }

    public function docs()
    {
        return $this->hasMany(AssetChild::class, 'sbu_id');
    }
}
