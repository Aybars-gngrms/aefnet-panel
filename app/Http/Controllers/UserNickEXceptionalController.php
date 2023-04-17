<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogRecordingController;

//? Library
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//? Models
use App\Models\Users;

class UserNickEXceptionalController extends Controller
{
    public function index()
    {
        $users = Users::whereIn('exceptional_id', [1, 2])->get();
        return view('user-process.user-nick-exceptional', compact('users'));
    }

    //** İstisna kaldırma
    public function deleteExceptional($id)
    {
        $user = Users::find($id);
        $user->exceptional_id = 3;
        $user->save();

        // Loglama işlemi
        // Loglama işlemi
        $logText = Carbon::now() ." ". Auth::user()->name ." adlı yetkili ". $user->player_nick." "."adlı oyuncunun istisnasını kaldırdı";
        $logMode = 'exceptional';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        return redirect()->back();
    }
}
