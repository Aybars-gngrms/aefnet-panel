<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HashController;
use Livewire\Component;

//? library
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LogRecordingController;

//? Models
use App\Models\Users;
use App\Models\BannedUsers;

class GamerBanComponent extends Component
{
    //** lviewire ın resim yükleme kütüphanesi
    use WithFileUploads;

    //** değişkenler
    public $gamer_id,  $user_ban_edit_id, $user_delete_id;
    public $ban_type, $ban_time, $ban_status, $ban_description, $ban_image, $who_banned, $view_ban_image;

    //** Validation error mesajlarını türkçeye çevirme
    public function messages()
    {
        return [
            'ban_type.required' => 'Lütfen ban türü seçiniz',
            'ban_time.required' => 'Lütfen ban süresi seçiniz',
            'ban_description.required' => 'Lütfen ban sebebini yazınız',
        ];
    }


    //** oyuncu ban popup açma
    public function banUsers($id)
    {
        $user = Users::where('id', $id)->first();
        $this->gamer_id = $user->gamer_id;
        $this->dispatchBrowserEvent('show-ban-user-modal');
    }

    //** oyuncu banlama
    public function banUserData()
    {
        // Form validation rules
        $this->validate([
            'ban_type' => 'required',
            'ban_time' => 'required',
            'ban_description' => 'required'
        ]);

        $user_ban = new BannedUsers();
        $user_ban->who_banned = Auth::user()->name;
        $user_ban->ban_type = $this->ban_type;
        $user_ban->gamer_id = $this->gamer_id;
        $user_ban->ban_time = $this->ban_time;
        $user_ban->ban_status = 1;
        $user_ban->ban_description = $this->ban_description;

        if ($this->ban_image) {
            $imageName = Carbon::now()->timestamp . '.' . $this->ban_image->extension();
            $this->ban_image->storeAs('ban_images', $imageName);
            $user_ban->ban_image = $imageName;
        }
        $user_ban->banned_date = Carbon::now()->format(date('d.m.Y'));
        $user_ban->save();


        //** Loglama işlemi
        $player_nick = Users::where('gamer_id', $this->gamer_id)->value('player_nick');
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncuyu banladı. Oyuncu Adı: " . $player_nick . " " . $user_ban->ban_time . " " . $user_ban->ban_type;
        $logMode = 'ban';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->ban_type = '';
        $this->ban_time = '';
        $this->ban_status = '';
        $this->ban_description = '';
        $this->ban_image = '';

        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-ban');
        session()->flash('success', 'Oyuncu banlandı');
    }



    //** oyuncu ban düzenleme popup açma
    public function ban_editUsers($id)
    {
        $user = Users::where('id', $id)->first();
        $hash = new HashController();
        $user_ban = BannedUsers::where('gamer_id', $user->gamer_id)->first();
        $this->user_ban_edit_id = $user->gamer_id;
        $this->ban_type = $user_ban->ban_type;
        $this->ban_time = $user_ban->ban_time;
        $this->ban_description =    $user_ban->ban_description;
        $this->ban_image = $user_ban->ban_image;
        $this->view_ban_image = $user_ban->ban_image;
        $this->dispatchBrowserEvent('show-ban-edit-user-modal');
    }


    //** oyuncu ban düzenleme
    public function baneditUserData()
    {
        $user_ban = BannedUsers::where('gamer_id', $this->user_ban_edit_id)->first();
        $user_ban->ban_type = $this->ban_type;
        $user_ban->ban_time = $this->ban_time;
        $user_ban->ban_description = $this->ban_description;
        if ($this->ban_image) {
            $imageName = Carbon::now()->timestamp . '.' . $this->ban_image->extension();
            $this->ban_image->storeAs('ban_images', $imageName);
            $user_ban->ban_image = $imageName;
        }
        $user_ban->save();

        //** Loglama işlemi
        $player_nick = Users::where('gamer_id', $this->gamer_id)->value('player_nick');
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili Oyuncu Adı: " . $player_nick . " olan oyuncunun banını düzenledi " . $user_ban->ban_time . " " . $user_ban->ban_type;

        $logMode = 'ban';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->ban_type = '';
        $this->ban_time = '';
        $this->ban_description = '';
        $this->ban_image = '';

        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-ban');
        session()->flash('success', 'Oyuncu ban bilgisi güncellendi');
    }

    //** popup kapatınca resetInputs çalıştırma
    public function close()
    {
        $this->resetInputs();
    }

    //** input sıfırlama
    public function resetInputs()
    {
        $this->gamer_id = '';
        $this->ban_type = '';
        $this->ban_time = '';
        $this->ban_description =  '';
        $this->ban_image = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal');
    }



    //** oyuncu ban kaldırma
    public function deleteUserData($id)
    {
        $user = Users::where('id', $id)->first();
        $user_ban = BannedUsers::where('gamer_id',  $user->gamer_id)->first();
        $user_ban->delete();

        //** Loglama işlemi
        $player_nick = Users::where('gamer_id', $this->gamer_id)->value('player_nick');
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncunun banını kaldırdı. Oyuncu Adı: " . $player_nick . " " . $user_ban->ban_time . " " . $user_ban->ban_type;
        $logMode = 'ban';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->user_delete_id = '';
        redirect('gamer-ban');
        session()->flash('success', 'Oyuncu banı kaldırıldı');
    }

    public function cancel()
    {
        $this->user_delete_id = '';
    }

    //** index
    public function render()
    {
        $users = Users::orderBy('player_nick', 'ASC')->get();
        $user_bans = BannedUsers::all();
        return view('livewire.gamer-ban-component', ['users' => $users, 'banned_users' => $user_bans])->layout('gamer-ban-process.gamer-ban');
    }
}
