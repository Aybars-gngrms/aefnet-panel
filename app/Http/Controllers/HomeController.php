<?php

namespace App\Http\Controllers;

//? Models
use App\Models\Users;
use App\Models\SystemAuthorities;
use App\Models\BannedUsers;
use App\Models\OnlineGamerCount;

class HomeController extends Controller
{
    public function index()
    {
        $users = Users::all();
        $admin = SystemAuthorities::all();
        $ban_users = BannedUsers::all();
        $online_gamer_count = OnlineGamerCount::all();
        $highest_player_count = $this->highestPlayerCountLast24Hours();
        return view('home' , compact('users', 'admin', 'ban_users', 'online_gamer_count', 'highest_player_count'));
    }

    public function highestPlayerCountLast24Hours() {
        $last24Hours = now()->subHours(24); // Şu andan 24 saat öncesini alıyoruz

        $highestCount = OnlineGamerCount::where('online_date', '>=', $last24Hours)
                        ->selectRaw('COUNT(*) as count')
                        ->orderBy('count', 'desc')
                        ->first();

        return $highestCount->count;
     }
}
