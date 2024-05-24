<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGroup extends Model
{
    use HasFactory;
    protected $table = 'document_group';
    protected $guarded = ['id'];
    protected $with = ['documents'];

    public function documents()
    {
        return $this->hasMany(AssetChild::class, 'document_id');
    }
}
