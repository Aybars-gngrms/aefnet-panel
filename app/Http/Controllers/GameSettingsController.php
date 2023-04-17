<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LogRecordingController;

//? Library
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


//? Models
use App\Models\Settings;

class GameSettingsController extends Controller
{
    public function index()
    {
        //** her ayar için ayrı olarak çekiyorum
        $settings1 = Settings::where('id', 1)->get();
        $settings2 = Settings::where('id', 2)->get();
        $settings3 = Settings::where('id', 3)->get();
        return view('settings/game-settings', compact('settings1', 'settings2', 'settings3'));
    }


    // ** Oyun bakım modu güncelleme
    public function update1(Request $request)
    {
        $settings_game = Settings::where('id', 1)->first();
        $hash = new HashController();
        $settings_game->settings_description = $request->input('settings_description');
        $settings_game->settings_status = $request->input('settings_status');

        $settings_game->save();

        // Loglama işlemi
        $logText = Carbon::now() ." ". Auth::user()->name ." adlı yetkili. Oyun bakım modunu güncelledi";
        $logMode = 'system';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        session()->flash('success', 'Oyun bakım modu güncellendi');
        return redirect()->back();
    }

    // ** Server bakım modu güncelleme
    public function update2(Request $request)
    {
        $settings_game = Settings::where('id', 2)->first();
        $hash = new HashController();
        $settings_game->settings_description = $request->input('settings_description');
        $settings_game->settings_status = $request->input('settings_status');

        $settings_game->save();

        // Loglama işlemi
        $logText = Carbon::now() ." ". Auth::user()->name ." adlı yetkili. Server bakım modunu güncelledi";
        $logMode = 'system';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        session()->flash('success', 'Server bakım modu güncellendi');
        return redirect()->back();
    }

    // ** Genel duyuru güncelleme
    public function update3(Request $request)
    {
        $settings_game = Settings::where('id', 3)->first();
        $hash = new HashController();
        $settings_game->settings_description = $request->input('settings_description');
        $settings_game->settings_status = $request->input('settings_status');

        $settings_game->save();

        // Loglama işlemi
        $logText = Carbon::now() ." ". Auth::user()->name ." adlı yetkili. Genel duyuru modunu güncelledi";
        $logMode = 'system';
        $log = new LogRecordingController();
        $log->createLogs($logText, $logMode);

        session()->flash('success', 'Genel duyuru güncellendi');
        return redirect()->back();
    }
}
