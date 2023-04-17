<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\LogRecordingController;
use App\Http\Controllers\HashController;

//? Library
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//? Models
use App\Models\Users;
use App\Models\BannedUsers;

class GamerBanListComponent extends Component
{
    //** değişkenler
    public
        $gamer_id,
        $user_ban_edit_id,
        $user_delete_id;
    public
        $view_ban_user_id,
        $view_ban_user_name,
        $view_ban_user_email,
        $view_ban_user_password,
        $view_ban_description,
        $view_ban_image;

    //** banlama detaylarını gösteren popup ı açar ve bilgileri yazdırır
    public function banDetail($id)
    {
        $user = Users::where('id', $id)->first();
        $hash = new HashController();
        $user_ban = BannedUsers::where('gamer_id', $user->gamer_id)->first();

        $this->view_ban_user_name = $user->player_nick;
        $this->view_ban_user_email = $user->email;
        $this->view_ban_description = $user_ban->ban_description;
        $this->view_ban_image = $user_ban->ban_image;



        $this->dispatchBrowserEvent('show-ban-detail-modal');
    }

    //** banlama detay popup ını kapatınca yazdırılan verileri siler
    public function closeViewUserModal()
    {
        $this->view_ban_user_name = '';
        $this->view_ban_user_email = '';
        $this->view_ban_description = '';
        $this->view_ban_image = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal');
    }

    //** oyuncu ban kaldırma
    public function deleteBanData($id)
    {
        $user = Users::where('id', $id)->first();
        $user_ban = BannedUsers::where('gamer_id', $user->gamer_id)->first();
        $player_nick = $user->player_nick;
        $user_ban->delete();
    
        //** Loglama işlemi
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncunun banını kaldırdı. Oyuncu Adı: " . $player_nick . " " . $user_ban->ban_time . " " . $user_ban->ban_type;
        $logMode = 'ban';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);
    
        $this->user_delete_id = '';
        redirect('gamer-ban-list');
        session()->flash('success', 'Oyuncu banı kaldırıldı');
    }
    
    


    public function cancel()
    {
        $this->user_delete_id = '';
    }

    //** index
    public function render()
    {
        $users = Users::all();
        $banned_users = BannedUsers::all();
        return view('livewire.gamer-ban-list-component', ['users' => $users, 'banned_users' => $banned_users])->layout('gamer-ban-process.gamer-ban-list');
    }
}
