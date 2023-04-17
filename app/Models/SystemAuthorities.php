<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class SystemAuthorities extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //** bağlandığı tablo
    protected $table = 'system_authorities';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;

    //** yetkilinin son giriş tarihini tabloya kaydeder */
    public function updateLastLoginDate()
    {
        $this->last_login_date = Carbon::now()->format('d.m.Y H:i:s');
        $this->save();
    }

    //** last login date sütunundaki verileri okunabilir hale getirir */
    //** diffForHumans = laravelde 2021-03-35::23:35 gibi zaman verileri 2 gün önce şeklinde çevirir

    //** tabloya authority_status yazdırırken yazı olarak gelmesini ayarlayan kısım */
    public function getAuthorityNameAttribute()
    {
        switch ($this->authority_status) {
            case 1:
                return 'Yönetici';
            case 2:
                return 'Admin';
            case 3:
                return 'Moderatör';
            default:
                return '';
        }
    }
}
