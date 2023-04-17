<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineGamerCount extends Model
{
    use HasFactory;

    //** bağlandığı tablo
    protected $table = 'onlines';
}
