<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Document extends Model
{
    use HasFactory;

    // Jika `doc_id` adalah primary key:
    protected $primaryKey = 'doc_id'; // Menetapkan doc_id sebagai primary key

    // Tentukan apakah kolom primary key auto-increment atau tidak
    public $incrementing = false; // Jika doc_id bukan auto-increment, set ini menjadi false

    // Kolom yang bisa diisi (fillable)
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
        'doc_id',
    ];

    // Relasi dengan model MasterItem
    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class, 'doc_partno', 'doc_partno');
    }


public static function boot()
{
    parent::boot();

    static::creating(function ($document) {
        // Tentukan tanggal kedaluwarsa dan tanggal sekarang
        $expiredDate = Carbon::parse($document->doc_expired_date);
        $currentDate = Carbon::now();

        // Tentukan status berdasarkan perbandingan tanggal
        $document->doc_status = ($expiredDate >= $currentDate) ? 1 : 0;
    });
}

}
