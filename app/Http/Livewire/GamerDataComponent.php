<?php

namespace App\Http\Livewire;

use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use App\Http\Controllers\HashController;
use App\Models\BannedUsers;
//? Modles
use App\Models\Users;
use App\Models\UserNickLogs;

class GamerDataComponent extends Component
{
    //** değişkenler
    public
        $view_user_id,
        $view_user_name,
        $view_user_email,
        $view_user_password,
        $view_user_security_question,
        $view_user_security_answer,
        $view_user_exceptional,
        $view_user_ban,
        $view_user_ip_addres,
        $view_user_created_at,
        $view_user_last_login_date,
        $view_user_computer_id;

    public
        $log_player_nick,
        $log_updated_at;


    //** oyuncu detayları popup ını açar ve bilgileri yazdırır
    public function viewUserDetails($id)
    {
        $user = Users::where('id', $id)->first();
        $hash = new HashController();
        $this->view_user_id = $user->gamer_id;
        $this->view_user_name = $user->player_nick;
        $this->view_user_email = $user->email;
        $this->view_user_password = $hash->AefnetHashCoz($user->password);
        $this->view_user_security_question = $user->security_question;
        $this->view_user_security_answer = $user->security_answer;
        $this->view_user_exceptional = $user->exceptional_id;
        $user_ban = BannedUsers::where('gamer_id', $user->gamer_id)->first();
        if ($user_ban) {
            $this->view_user_ban = $user_ban->ban_time." Gün ".$user_ban->ban_type;
        } else {
            $this->view_user_ban = 'Cezası yok';
        }
        $this->view_user_ip_addres = $user->ip_address;
        $this->view_user_created_at = $user->created_at;
        $this->view_user_last_login_date = $user->last_login_date;
        $this->view_user_computer_id = $user->computer_id;

        $this->dispatchBrowserEvent('show-view-user-modal');
    }

    //** oyuncunun ad geçmişini görüntüleyen popup açar ve yazdırır
    public function adlogUserDetails($id)
    {
        $user = Users::where('id', $id)->first();
        $hash = new HashController();
        if (!$user) {
            return; // veya hata mesajı döndürülebilir
        }

        $log = UserNickLogs::where('gamer_id', $user->gamer_id)->first();
        if ($log) {

            $this->log_player_nick = $log->new_player_nick;
            $this->log_updated_at = $log->updated_at;
        } else {
            $this->log_player_nick = "";
            $this->log_updated_at = "";
        }

        $this->dispatchBrowserEvent('show-ad-log-modal');
    }

    //** oyuncu detaylar popup ı kapanınca verileri boşaltır
    public function closeViewUserModal()
    {
        $this->view_user_id = '';
        $this->view_user_name = '';
        $this->view_user_email = '';
        $this->view_user_password = '';
        $this->view_user_security_question = '';
        $this->view_user_security_answer = '';
        $this->view_user_exceptional = '';
        $this->view_user_ban = '';
        $this->view_user_ip_addres = '';
        $this->view_user_created_at = '';
        $this->view_user_last_login_date = '';
        $this->view_user_computer_id = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    //** index
    public function render()
    {
        $users = Users::orderBy('player_nick', 'ASC')->get();
        $user_nick_historys = UserNickLogs::all();
        return view('livewire.gamer-data-component', ['users' => $users, 'user_nick_historys' => $user_nick_historys])->layout('user-process.gamer-data');
    }
}
