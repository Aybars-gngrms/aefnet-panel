<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\LogRecordingController;
use App\Http\Controllers\HashController;


//? Librarys
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


//? Models
use App\Models\SystemAuthorities; // system_manager
use App\Models\Managers; // manager

class SystemAuthoritiesComponent extends Component
{
    public $name, $email, $manager, $security_question, $security_answer, $password, $system_manager_edit_id, $system_manager_delete_id;

    public $system_manager_id;


    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'manager' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'security_question' => 'required',
            'security_answer' => 'required'
        ]);
    }

    //** Validation error mesajlarını türkçeye çevirme
    public function messages()
    {
        return [
            'manager.required' => 'Lütfen yetki giriniz',
            'name.required' => 'Lütfen yetkili adı giriniz',
            'name.unique' => 'Bu yetkili adı kullanılıyor lütfen başka bir ad giriniz', 
            'email.required' => 'Lütfen e-mail giriniz',
            'email.email' => 'Lütfen Geçerli bir e-mail giriniz',
            'password.required' => 'Lütfen Şifrenizi giriniz',
            'security_question.required' => 'Lütfen güvenlik sorunuzu seçiniz',
            'security_answer.required' => 'Lütfen güvenlik sorunuzu cevabını yazınız',
        ];
    }

    //** Yetkili ekleme popup açma
    public function addSystem_managerModal()
    {
        $this->dispatchBrowserEvent('show-new-manager-modal');
    }
    //** Yetkili ekleme
    public function storeSystem_managerData()
    {
        $this->validate([
            'manager' => 'required',
            'name' => 'required|unique:system_authorities,name',
            'email' => 'required|email',
            'password' => 'required',
            'security_question' => 'required',
            'security_answer' => 'required',
        ]);


        //** Yetkili tablosuna yetkili ekleme
        $system_manager = new SystemAuthorities();
        $hash = new HashController;
        $system_manager->authority_status = $this->manager;
        $system_manager->name = $this->name;
        $system_manager->email = $this->email;
        $system_manager->security_question = $this->security_question;
        $system_manager->security_answer = $this->security_answer;
        $system_manager->password = $hash->AefnetHash($this->password);

        $system_manager->save();

        // Loglama işlemi
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili. Yeni yetkili ekledi Yetkili adı:" . $this->name;
        $logMode = 'manager';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);


        //For hide modal after add system_manager success
        $this->dispatchBrowserEvent('close-modal');
        redirect('managers');
        session()->flash('success', 'Yeni yetkili eklendi');
    }

    //** resetInputs u çalıştırma
    public function close()
    {
        $this->resetInputs();
    }

    //** input ve validation error u 0 lama */
    public function resetInputs()
    {
        $this->manager = '';
        $this->name = '';
        $this->email = '';
        $this->password =  '';
        $this->security_question = '';
        $this->security_answer = '';
        $this->system_manager_edit_id = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('close-modal');
    }



    //** Yetkili düzenleme popup açma
    public function editSystem_managers($id)
    {
        //burası verilerin yazdırıldığı ve popup ın açıldığı yer
        $hash = new HashController();
        $system_manager = SystemAuthorities::where('id', $id)->first();
        $this->system_manager_edit_id = $system_manager->id;
        $this->manager = $system_manager->authority_status;
        $this->name = $system_manager->name;
        $this->email =  $system_manager->email;
        $this->security_question = $system_manager->security_question;
        $this->security_answer = $system_manager->security_answer;
        $this->dispatchBrowserEvent('show-edit-system_manager-modal');
    }




    //** Yetkili düzenleme post
    public function editSystem_managerData()
    {
        $this->validate([
            'manager' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'security_question' => 'required',
            'security_answer' => 'required',
        ]);

        $system_manager = SystemAuthorities::where('id', $this->system_manager_edit_id)->first();
        $hash = new HashController();
        //sal bana
        $system_manager->authority_status = $this->manager;
        $system_manager->name = $this->name;
        $system_manager->email = $this->email;
        $system_manager->security_question = $this->security_question;
        $system_manager->security_answer = $this->security_answer;
        if($this->password == "")
        {
            $system_manager->password =  $system_manager->password;
        }
        else
        {
            $system_manager->password  = $hash->AefnetHash($this->password);
        }
        $system_manager->save();
        // Loglama işlemi

        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili. " . $this->name . " adlı yetkiliyi düzenledi ";
        $logMode = 'manager';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->manager = '';
        $this->name = '';
        $this->email = '';
        $this->security_question = '';
        $this->security_answer = '';
        $this->password = '';

        $this->dispatchBrowserEvent('close-modal');
        redirect('managers');
        session()->flash('success', 'Yetkili bilgileri güncellendi');
    }

    //** Yetkili silme popup açma
    public function deleteConfirmation($id)
    {
        $this->system_manager_delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }
    //bi denemeler yap hata nerede bakalım
    //** Yetkili silme post
    public function deleteSystem_managerData()
    {
        $system_manager = SystemAuthorities::where('id', $this->system_manager_delete_id)->first();
        $system_manager->delete();

        // Loglama işlemi
        $hash = new HashController();
        $logText = Carbon::now() . " " . Auth::user()->name . " adlı yetkili. " . $system_manager->name . " adlı yetkiliyi sildi ";
        $logMode = 'manager';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        $this->dispatchBrowserEvent('close-modal');
        $this->system_manager_delete_id = '';
        redirect('managers');
        session()->flash('success', 'Yetkili başarıyla silindi');
    }

    //** Yetkili silme iptal
    public function cancel()
    {
        $this->system_manager_delete_id = '';
    }

    //** yetkililer ve yetkiler tablosundaki veriler döner */
    public function render()
    {
        $managers = Managers::all();
        $system_authorities = SystemAuthorities::orderBy('name', 'ASC')->get();
        return view('livewire.managers-component', ['system_authorities' => $system_authorities, 'managers' => $managers])->layout('managers.managers');
    }
}
