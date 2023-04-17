<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    //** bağlandığı tablo
    protected $table = 'site_settings';

    //** updated_at gibi zorunlu tablo verilerini iptal eder
    public $timestamps = false;
}
