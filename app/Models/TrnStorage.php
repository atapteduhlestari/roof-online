<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnStorage extends Model
{
    use HasFactory;

    protected $table = 'trn_storage';
    protected $guarded = ['id'];
}
