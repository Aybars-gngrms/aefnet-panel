<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managers extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'managers';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;

    //** yetkililer tablosundaki authority_status sütununa bağlıyoruz
    public function systemAuthority()
    {
        return $this->belongsTo(SystemAuthority::class, 'authority_status');
    }





}
