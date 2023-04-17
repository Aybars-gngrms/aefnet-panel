<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//? Library
use Carbon\Carbon;

class UserNickLogs extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'user_nick_historys';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;

    protected $fillable = [
        'gamer_id',
        'new_player_nick',
        'updated_at',
    ];

    //** oluşturma tarihini okunabilir hale getirir
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
