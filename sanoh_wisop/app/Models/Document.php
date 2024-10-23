<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_partno',
        'doc_type',
        'doc_path',
        'doc_rev',
        'doc_effective_date',
        'doc_expired_date',
        'doc_status',
        'doc_customer',
        'doc_dept',
        'doc_process',
    ];

    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class, 'doc_partno', 'doc_partno');
    }
}
