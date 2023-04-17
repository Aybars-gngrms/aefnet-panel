<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//? Librarys
use Carbon\Carbon;

class UserMessages extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'messages';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;

    //** users  tablosu ile messages tablosundaki id leri bağlar*/
    public function user_gamer_id()
    {
        return $this->hasOne('App\Models\Users', 'user_id', 'gamer_id');
    }

    //** oluşturulma tarihini okunabilir hale getirir */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }


}
