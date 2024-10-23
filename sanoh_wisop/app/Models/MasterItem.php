<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_partno',
        'desc',
        'part_alias',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'doc_partno', 'doc_partno');
    }
}
