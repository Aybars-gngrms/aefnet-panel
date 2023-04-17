<?php

namespace App\Http\Livewire;

//? Modles
use App\Models\Users;
use App\Models\Exceptionals;
use App\Models\UserMessages;

//? Library
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

//? Controller
use App\Http\Controllers\HashController;
use App\Http\Controllers\LogRecordingController;


class GamerProcessComponent extends Component
{


    public $gamer_id, $player_nick, $exceptional_id, $email, $security_question, $security_answer, $password, $user_edit_id, $user_exceptional_id, $user_delete_id;

    public $admin_id, $user_id, $subject, $content, $status, $created_at;


    //** gamer_id oluşturan function
    public function GUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
    //** Validation error mesajlarını türkçeye çevirme
    public function messages()
    {
        return [
            'player_nick.required' => 'Lütfen yetkili adı giriniz',
            'player_nick.unique' => 'Bu oyuncu adı kullanılıyor lütfen başka bir ad giriniz',
            'player_nick.max' => 'En fazla 16 karakter içerebilir',
            'email.required' => 'Lütfen e-mail giriniz',
            'email.email' => 'Lütfen Geçerli bir e-mail giriniz',
            'password.required' => 'Lütfen Şifrenizi giriniz',
            'security_question.required' => 'Lütfen güvenlik sorunuzu seçiniz',
            'security_answer.required' => 'Lütfen güvenlik sorunuzu cevabını yazınız',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'player_nick' => 'required',
            'email' => 'required|email',
        ]);
    }

    //** oyuncu ekleme popup açma
    public function storeUser()
    {
        $this->dispatchBrowserEvent('show-new-user-modal');
    }

    //** Oyuncu ekleme
    public function storeUserData()
    {
        $hash = new HashController();
        
        $this->validate([
            'player_nick' => 'required|unique:users,player_nick|max:16',
            'email' => 'required|email',
            'password' => 'required',
            'security_question' => 'required',
            'security_answer' => 'required',
        ]);
        

        // Oyuncu Ekle
        $user = new Users();
        
        $user->gamer_id = $this->GUID();
        $user->player_nick =    $this->player_nick;
        $user->email = $this->email;
        $user->security_question = $this->security_question;
        $user->security_answer = $this->security_answer;
        $user->password = $hash->AefnetHash($this->password);
        $user->last_login_date = Carbon::now()->format('d.m.Y H:i:s');
        $user->created_at = Carbon::now()->format('d.m.Y H:i:s');
        $user->save();


        // Loglama işlemi
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncu ekledi. Oyuncu adı:" . $this->player_nick;
        $logMode = 'user';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->password = '';
        $this->player_nick = '';
        $this->email = '';
        $this->security_question = '';
        $this->security_answer = '';



        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-process');
        session()->flash('success', 'Yeni oyuncu başarıyla eklendi');
    }

    //** Mesaj popup açma
    public function messageUsers($id)
    {
        $user = Users::where('id', $id)->first();
        $this->gamer_id = $user->gamer_id;
        $this->dispatchBrowserEvent('show-message-user-modal');
    }

    //* Mesaj Post
    public function messageUserData()
    {
        $this->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);
        $hash = new HashController();
        $message = new UserMessages();
        $message->user_id = $this->gamer_id;
        $message->admin_id = Auth::user()->id;
        $message->subject = $this->subject;
        $message->content = $this->content;
        $message->status = 1;
        $message->created_at = now();
        $message->save();



        $this->subject = '';
        $this->content = '';

        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-process');
        session()->flash('success', 'Oyuncuya mesaj gönderildi');
    }

    //** resetInputs functionunu çalıştırır
    public function close()
    {
        $this->resetInputs();
    }

    //** popup kapatınca inputları 0 lar ve validate error mesajlarını 0 lar
    public function resetInputs()
    {
        $this->gamer_id = '';
        $this->player_nick = '';
        $this->email = '';
        $this->password =  '';
        $this->security_question = '';
        $this->security_answer = '';
        $this->user_edit_id = '';
        $this->user_exceptional_id = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal');

    }



    //** Oyuncu düzenleme popup açma
    public function editUsers($id)
    {
        $user = Users::where('id', $id)->first();
        $hash = new HashController();
        $this->user_edit_id = $user->id;
        $this->player_nick = $user->player_nick;
        $this->email = $user->email;
        $this->security_question = $user->security_question;
        $this->security_answer =  $user->security_answer;
        $this->dispatchBrowserEvent('show-edit-user-modal');
    }


    //** Oyuncu düzenleme post
    public function editUserData()
    {
        $user = Users::where('id', $this->user_edit_id)->first();
        $hash = new HashController();
        $user->player_nick = $this->player_nick;
        $user->email = $this->email;
        $user->security_question = $this->security_question;
        $user->security_answer = $this->security_answer;
        if($this->password == "")
        {
            $user->password = $user->password;
        }
        else
        {
            $user->password = $hash->AefnetHash($this->password);
        }
        $user->save();


        // Loglama işlemi
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncuyu düzenledi. Oyuncu adı:" . $this->player_nick;
        $logMode = 'user';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);


        $this->player_nick = '';
        $this->email = '';
        $this->security_question = '';
        $this->security_answer = '';
        $this->password = '';

        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-process');
        session()->flash('success', 'Oyuncu Başarıyla güncellendi');
    }


    //** İstisna ekleme popup açma
    public function exceptionalUsers($id)
    {
        $user = Users::where('id', $id)->first();

        $this->user_exceptional_id = $user->id;
        $this->exceptional_id = $user->exceptional_id;
        $this->dispatchBrowserEvent('show-exceptional-user-modal');
    }

    //** İstisna ekleme post
    public function exceptionalUserData()
    {
        $user = Users::where('id', $this->user_exceptional_id)->first();
        $user->exceptional_id = $this->exceptional_id; // exceptional_id'yi güncelle
        $user->save(); // Değişiklikleri veritabanına kaydet

        // Loglama işlemi
        $hash = new HashController();
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncu ya istisna ekledi. Oyuncu adı:" . $user->player_nick;
        $logMode = 'exceptional';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->dispatchBrowserEvent('close-modal');
        redirect('gamer-process');
        session()->flash('success', 'Başarıyla istisna eklendi');
    }

    //** Oyuncu silme popup açma
    public function deleteConfirmation($id)
    {
        $this->user_delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    //** Oyuncu silme post
    public function deleteUserData()
    {
        $user = Users::where('id', $this->user_delete_id)->first();
        $user->delete();

        // Loglama işlemi
        $hash = new HashController();
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili oyuncuyu sildi. Oyuncu adı:" . $user->player_nick;
        $logMode = 'user';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->dispatchBrowserEvent('close-modal');

        redirect('gamer-process');
        session()->flash('success', 'Oyuncu Başarıyla Silindi');
        $this->user_delete_id = '';
    }

    //** Oyuncu Silme İptal
    public function cancel()
    {
        $this->user_delete_id = '';
    }

    //** sayfa ve popupların olduğu yeri döndürdüğümüz,
    //** index = render
    public function render()
    {
        $users = Users::orderBy('player_nick', 'ASC')->get();
        $exceptionals = Exceptionals::all();
        $messages = UserMessages::orderBy('created_at', 'ASC')->get();

        return view('livewire.gamer-process-component', ['users' => $users, 'exceptionals' => $exceptionals, 'messages' => $messages])->layout('user-process.gamer-process');
    }
}
