<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUsers extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'banned_users';
    
    //** updated_at gibi zorunlu tablo verilerini iptal eder */
    public $timestamps = false;
}
