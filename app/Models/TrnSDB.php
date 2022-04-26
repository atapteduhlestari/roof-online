<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnSDB extends Model
{
    use HasFactory;
    protected $table = 'trn_sdb';
    protected $guarded = ['id'];

    public function sdb()
    {
        return $this->belongsTo(SDB::class, 'sdb_id');
    }
}
