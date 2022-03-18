<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnMaintenance extends Model
{
    use HasFactory;

    protected $table = 'trn_maintenance';
    protected $guarded = ['id'];
}
