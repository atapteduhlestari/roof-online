<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function renewals()
    {
        return $this->hasMany(Renewal::class, 'cycle_id');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'cycle_id');
    }
}
