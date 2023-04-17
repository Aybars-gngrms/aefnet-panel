<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HashController;

//? Models
use App\Models\Users;
use App\Models\UserMessages;

class GamerProcessMessageListController extends Controller
{
    // ** Mesajlar , listeleme
    public function index($gamer_id)
    {
        $hash = new HashController();
        $data['users'] = Users::where('gamer_id', $gamer_id)->get();
        $data['messages'] = UserMessages::where('user_id', $gamer_id)->get();
        return view('user-process.gamer-process-message-list', $data);

    }

    // ** Mesaj Silme
    public function messageDelete($id)
    {
        $messages= UserMessages::find($id);
        $messages->delete();
        session()->flash('success', 'Mesaj başarıyla silindi');
        return redirect()->route('gamer-process.index');
    }
}
