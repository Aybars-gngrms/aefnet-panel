<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'settings';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;
}
