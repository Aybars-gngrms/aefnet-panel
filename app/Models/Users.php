<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//?Librarys
use Carbon\Carbon;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //** bağlandığı tablo
    protected $table = 'users';

    //** updated_at gibi zorunlu tablo verilerini iptal eder */
    public $timestamps = false;

    //** istisna tablosu ile users tablosundaki id leri bağlar */
    function getExceptional()
    {
        return $this->hasOne('App\Models\Exceptionals', 'id', 'exceptional_id');
    }

    //** oluşturma tarihini okunabilir hale getirir
    public function getCreatedAtAttribute()
    {
        return Carbon::now()->format('d.m.Y H:i:s');;
    }

    //** Son giriş tarihini okunabilir hale getirir
    public function getLastLoginDateAttribute()
    {
        return Carbon::now()->format('d.m.Y H:i:s');
    }

    //** ad güncelleme tarihini okunabilir hale getirir
    public function getNickUpdateDateAttribute()
    {
        return Carbon::now()->format('d.m.Y H:i:s');
    }

    //** kullanıcı adının log unu tutar */
    //** kullanıcı güncelleme işlmeni izler işlem yapılırsa yapılmadan önceki kullanıcı adını, yenisini ve güncelleme tarihini tutar
    //** ve bu verileri log tutulan tabloya yeni veri oluşturarak yazar
    protected static function boot()
    {
        parent::boot();
        static::updated(function ($users) {
            UserNickLogs::create([
                'gamer_id' => $users->gamer_id,
                'new_player_nick' => $users->player_nick,
                'updated_at' => Carbon::Now()->format('d-m-Y H:i:s')
            ]);
        });
    }


}
