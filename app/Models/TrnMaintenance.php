<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnMaintenance extends Model
{
    use HasFactory;

    protected $table = 'trn_maintenance';
    protected $guarded = ['id'];

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
}
